<?php

error_reporting(E_ALL);

// Can we explore taxonomy models in Wikidata simply using some code?


/*


 operations
 
 - extract classification from one source
 	- easy to do if table has one row per name and source
 	- harder if we compress
 
 - compress table using names (gives us Wikidata model)
	- merge rows that have same name, store ids and refs for edges
 	- compress doesn't assert that these are the same taxa, merely that they have the same name
 
 - pick preferred Classification
  	- can we do this by voting, in effect wikipedian editors reacha  consensus on which name to use
 
 - attributues of taxon
 	- use synonyms to combine attributes
 
 - generate taxobox
 	- what queries needed to create taxobox
 	
 - how do we populate wikidata?
 
 */

//----------------------------------------------------------------------------------------
class Taxon 
{
	var $parent;
	var $id;
	var $name;
	var $accepted;
	var $source;
	
	function __construct($args)
	{
		$this->id = null;
		$this->parent = null;
		$this->accepted = null;
		$this->source = 'default';
		
		$this->name = '';
		
		foreach ($args as $k => $v)
		{
			$this->{$k} = $v;
		}

		
	}
	

}

//----------------------------------------------------------------------------------------

class Classification
{
	var $nodes = array();
	
	var $node_names = array();
	var $node_source_id = array();
	
	
	//------------------------------------------------------------------------------------
	function __construct()
	{
		$this->nodes = array();
	}
	
	//------------------------------------------------------------------------------------
	function AddNode($node)
	{
		$this->nodes[] = $node;
		
		$source = 'default';
		if (isset($node->source))
		{
			$source = $node->source;
		}
		
		if (!isset($this->node_source_id[$source]))
		{
			$this->node_source_id[$source] = array();
		}
		
		$this->node_source_id[$source][$node->id] = $node;
		
		if (!isset($this->node_names[$node->name]))
		{
			$this->node_names[$node->name] = array();
		}		
		$this->node_names[$node->name][$source] = $node;
	}
	
	//------------------------------------------------------------------------------------
	function FindNodeByName($name, $source = 'default')
	{
		$node = null;
		
		if (isset($this->node_names[$name]))
		{
			if (isset($this->node_names[$name][$source]))
			{
				$node = $this->node_names[$name][$source];
			}
		}
		
		return $node;
	}
	
	//------------------------------------------------------------------------------------
	function FindNodeById($id, $source = 'default')
	{
		$node = null;
		
		if ($this->node_source_id[$source][$id])
		{
			$node = $this->node_source_id[$source][$id];
		}
		
		return $node;
	}	
	
	//------------------------------------------------------------------------------------
	function ToTable()
	{
		$rows = array();
		$header = array('id', 'name', 'parent', 'accepted', 'source');
		
		$rows[] = $header;
	
		foreach ($this->nodes as $node)
		{
			$row = array();
			foreach ($header as $k)
			{
				if (isset($node->{$k}))
				{
					$row[] = $node->{$k};
				}
				else
				{
					$row[] = '';
				}
			}
			$rows[] = $row;		
		}
		
		print_r($rows);
		
		$html = '<table>';
		
		$html .= '<tr>';
		$html .= '<th>';
		$html .= join('</th><th>', $header);
		$html .= '</th>';
		$html .= '</tr>';
		
		$n = count($rows);
		for ($i = 1; $i < $n; $i++)
		{
			$html .= '<tr>';
			$html .= '<td>';
			$html .= join('</td><td>', $rows[$i]);
			$html .= '</td>';
			$html .= '</tr>';			
		}
		
		$html .= '<table>';
		
		echo $html;
	}	
	
	//------------------------------------------------------------------------------------
	function ToGraph()
	{
	
	}
	
	//------------------------------------------------------------------------------------
	function Compress()
	{
		$items = array();
		$name_to_item = array();
		
		$item_count = 1;
		
		// create nodes
		foreach ($this->nodes as $node)
		{
			if (!isset($items[$node->name]))
			{
				
				$items[$node->name] = new stdclass;
				$items[$node->name]->id = $item_count++;
				$items[$node->name]->external_ids = array();
				$items[$node->name]->parent = array();
				$items[$node->name]->accepted = array();
				
				$name_to_item[$node->name] = $items[$node->name]->id;
			}
			$items[$node->name]->name = $node->name;
			$items[$node->name]->external_ids[] = $node->source . ':' . $node->id;
		}
		
		// links between nodes, e.g. parents, synonyms
		foreach ($this->nodes as $node)
		{
			// parent
			if (isset($node->parent))
			{
				$p = $this->FindNodeById($node->parent, $node->source);
				if ($p)
				{
					if (!isset($items[$node->name]->parent[$p->name]))
					{
						$items[$node->name]->parent[$p->name] = array();
					}
				
					$items[$node->name]->parent[$p->name][] = $p->source;
				}
			}
			
			// accepted
			if (isset($node->accepted))
			{
				$p = $this->FindNodeById($node->accepted, $node->source);
				if ($p)
				{
					if (!isset($items[$node->name]->accepted[$p->name]))
					{
						$items[$node->name]->accepted[$p->name] = array();
					}
				
					$items[$node->name]->accepted[$p->name][] = $p->source;
				}
			}
			
		}
	
				
	
		echo '<pre>';
		print_r($items);
		echo '</pre>';
	
	}
	

}

$c = new Classification();

// add some bieds form one source

$count = 1;

$source = 'a';

$node = new Taxon(array(
	'name' => 'Picidae',
	'id' => $count++,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Picidae', $source)->id,	
	'source' => $source
));

$c->AddNode($node);



$node = new Taxon(array(
	'name' => 'Sasia abnormis',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia africana',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia ochracea',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

// Verreauxia

$node = new Taxon(array(
	'name' => 'Verreauxia',
	'id' => $count++,
	'accepted' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
));

$c->AddNode($node);


$node = new Taxon(array(
	'name' => 'Verreauxia africana',
	'id' => $count++,
	'accepted' => $c->FindNodeByName('Sasia africana', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

// second classification ----------------

$source = 'b';

$node = new Taxon(array(
	'name' => 'Picidae',
	'id' => $count++,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Picidae', $source)->id,		
	'source' => $source
));

$c->AddNode($node);

// Verreauxia

$node = new Taxon(array(
	'name' => 'Verreauxia',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Picidae', $source)->id,		
	'source' => $source
));

$c->AddNode($node);


$node = new Taxon(array(
	'name' => 'Verreauxia africana',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Verreauxia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);


$node = new Taxon(array(
	'name' => 'Sasia abnormis',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia africana',
	'id' => $count++,
	'accepted' => $c->FindNodeByName('Verreauxia africana', $source)->id,
	'source' => $source
	));

$c->AddNode($node);

$node = new Taxon(array(
	'name' => 'Sasia ochracea',
	'id' => $count++,
	'parent' => $c->FindNodeByName('Sasia', $source)->id,
	'source' => $source
	));

$c->AddNode($node);







$c->ToTable();

$c->Compress();


?>





