(function() {
    var h = function() {};
    var q = {
            creators_name: "author",
            creator: "author",
            contributor: "author",
            issued: "publication_year",
            publication_date: "publication_year",
            date: "year"
        },
        r = {
            "abstract": 1,
            description: 1,
            keyword: 1,
            keywords: 1,
            reference: 1
        },
        u = /^.*_(url|email|institution)$/,
        v = /  +/g,
        w = function(a, b, c) {
            a = q[a] || a;
            !b || r[a] || u.test(a) || c.push(encodeURIComponent(a) + "=" + encodeURIComponent(b))
        },
        x = "innerText" in document.documentElement ? function(a) {
            return a.innerText
        } : function(a) {
            if (1 == a.nodeType) {
                var b = document.defaultView.getComputedStyle(a);
                return "none" == b.display || "hidden" == b.visibility || 0 >= parseFloat(b.fontSize) || 0 >= parseFloat(b.opacity) ? "" : Array.prototype.map.call(a.childNodes, x).join(" ").replace(v, " ")
            }
            return a.textContent
        };
    var y = function() {
        function a(a) {
            return a.match(b) ? a.replace(c, "") : a
        }
        for (var b = /<(p|br)>|<\/.*>|<.*\/>/i, c = /<[^>]+>/g, e = document.getElementsByTagName("meta"), g = [], d = [], k = [], l = [], p = [], m = /[.-]/g, t = 0, F = e.length; t < F; ++t) {
            var f = (e[t].name || "").toLowerCase().replace(m, "_"),
                n = a(e[t].content || "");
            0 == f.indexOf("citation_") ? w(f.substr(9), n, g) : 0 == f.indexOf("eprints_") ? w(f.substr(8), n, d) : 0 == f.indexOf("bepress_citation_") ? w(f.substr(17), n, k) : 0 == f.indexOf("wkhealth_") ? w(f.substr(9), n, l) : 0 == f.indexOf("dc_") ? w(f.substr(3),
            n, p) : 0 == f.indexOf("dcterms_") && w(f.substr(8), n, p)
        }
        e = [g, d, k, l, p];
        g = /^author=/;
        var G = /^title=/;
        for (d = 0; d < e.length; ++d) {
            k = e[d];
            l = [];
            for (m = p = 0; m < k.length; ++m)
                (!g.test(k[m]) || 5 >= ++p) && l.push(k[m]);
            if (l.some(function(a) {
                return G.test(a)
            }))
                return l
        }
        return []
    };
    /[?&]tc=([01])/.exec(location.search || "") || 0 <= (navigator.userAgent || "").indexOf("Android") || window.matchMedia && window.matchMedia("(pointer)").matches && window.matchMedia("(pointer:coarse)");
    var A = function(a, b) {
            a.href = b && b.match(z) ? b : "javascript:void(0)"
        },
        z = /^(?:https?:|[^:/?#]*(?:[/?#]|$))/i;
    function B(a) {
        var b = 0;
        return function() {
            b || (b = window.requestAnimationFrame(function() {
                b = 0;
                a()
            }))
        }
    }
    function C(a, b, c) {
        b = document.createElement(b);
        b.id = c;
        a.appendChild(b);
        return b
    }
    var D = function(a, b) {
            this.h = a;
            this.b = b;
            this.a = this.c = !1;
            this.g = this.f = 0
        },
        E = function(a) {
            var b = a.b.getBoundingClientRect(),
                c = a.h.getBoundingClientRect();
            a.f += b.bottom - c.top;
            a.h.style.top = a.f + "px"
        },
        H = function(a, b) {
            if (a.a) {
                var c = a.b.getBoundingClientRect();
                c = a.g - c.bottom;
                var e = 75 * a.g / 100;
                a.o = b - (c - 100);
                a.m = b + (e - c)
            }
        };
    D.prototype.l = function() {
        var a = window.pageYOffset,
            b = void 0 == this.j ? 0 : a - this.j;
        this.j = a;
        if (this.c) {
            if (0 <= b)
                return;
            this.c = !1;
            this.a = !0;
            E(this);
            H(this, a)
        } else if (this.a)
            a >= this.m ? (this.c = !0, this.a = !1) : a <= this.o && (this.a = !1);
        else {
            if (0 >= b)
                return;
            this.a = !0;
            E(this);
            H(this, a)
        }
        a = this.b.classList;
        this.c ? a.add("gs-casa-top") : a.remove("gs-casa-top");
        a = this.b.classList;
        this.a ? a.add("gs-casa-mid") : a.remove("gs-casa-mid")
    };
    D.prototype.i = function() {
        this.g = window.innerHeight;
        H(this, window.pageYOffset);
        this.l()
    };
    D.prototype.s = function() {
        window.addEventListener("resize", B(this.i.bind(this)));
        this.i();
        window.addEventListener("scroll", B(this.l.bind(this)))
    };
    function I(a) {
        if (200 == a.status) {
            a = a.responseText;
            var b = a.indexOf("\n");
            if (!(0 > b)) {
                try {
                    var c = JSON.parse(a.substr(b))
                } catch (k) {
                    return
                }
                if (a = c)
                    a = typeof c, a = "object" == a && null != c || "function" == a;
                if (a) {
                    if (a = c.html)
                        c = "Full Text";
                    else if (a = c.pdf)
                        c = "PDF";
                    else
                        return;
                    b = c;
                    var e = a;
                    if (!document.getElementById("gs-casa-r")) {
                        c = C(document.body, "div", "gs-casa-r");
                        (window.matchMedia && window.matchMedia("(pointer)").matches ? window.matchMedia("(pointer:coarse)").matches : 0 <= (navigator.userAgent || "").indexOf("Firefox") &&
                        !(0 <= (navigator.userAgent || "").indexOf("Android")) ? 0 : "ontouchstart" in window) && c.classList.add("gs-casa-touch");
                        a = C(c, "div", "gs-casa-c");
                        var g = C(a, "div", "gs-casa-b");
                        g.addEventListener("touchstart", h, {
                            passive: !0
                        });
                        var d = C(g, "a", "gs-casa-f");
                        d.textContent = b;
                        A(d, e);
                        b = C(g, "a", "gs-casa-h");
                        b.target = "_blank";
                        b.textContent = "Help";
                        A(b, "https://scholar.google.com/scholar/help.html#access");
                        b = document.createElement("style");
                        b.textContent = '#gs-casa-r,#gs-casa-c,#gs-casa-b,#gs-casa-f,#gs-casa-h{background:transparent;border:0;box-sizing:content-box;font-family:Arial,sans-serif;font-weight:normal;letter-spacing:normal;line-height:normal;margin:0;opacity:1;outline:none;overflow:visible;padding:0;pointer-events:auto;text-decoration:none;text-transform:none;transition:none;vertical-align:baseline;z-index:0}#gs-casa-r{height:0;position:absolute;right:0;top:0;width:0;z-index:2147483647}#gs-casa-c{bottom:100px;height:110px;overflow:hidden;pointer-events:none;position:fixed;right:0;width:116px}#gs-casa-c.gs-casa-top{bottom:75%;position:fixed}#gs-casa-c.gs-casa-mid{position:absolute;bottom:0}#gs-casa-b{animation:gs-casa-a-l-ent .225s cubic-bezier(.0,.0,.2,1) forwards;perspective:1px;position:absolute;right:0;text-align:center;top:20px;width:96px}#gs-casa-b::before,#gs-casa-b::after{border-radius:8px 0 0 8px;content:"";height:100%;left:0;perspective:1px;position:absolute;top:0;transform:translate3d(0,0,0);transition:opacity .2s;width:100%;z-index:-1}#gs-casa-b::before{box-shadow:0 0px 2px 0 rgba(0,0,0,.14),0 2px 2px 0 rgba(0,0,0,.12),0 4px 15px 0 rgba(0,0,0,.2);opacity:1}#gs-casa-b::after{box-shadow:0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 3px rgba(0,0,0,.12),0 4px 15px 0 rgba(0,0,0,.2);opacity:0}#gs-casa-b:active::before{opacity:0}#gs-casa-b:active::after{opacity:1}#gs-casa-f,#gs-casa-h{display:block;overflow:hidden;padding-left:4px}#gs-casa-f{background-color:#424242;border-radius:8px 0 0 0;color:#fff;font-size:18px;height:54px;line-height:54px;word-spacing:-2px}#gs-casa-h{background-color:#777;border-radius:0 0 0 8px;color:#e0e0e0;font-size:11px;height:16px;line-height:16px}@keyframes gs-casa-a-l-ent{0%{transform:translate3d(96px,0,0)}100%{transform:translate3d(0,0,0)}}.gs-casa-touch #gs-casa-c{bottom:30vh;position:fixed;transform:translate(0,48px)}@media (max-width:599px),(max-height:599px){#gs-casa-c,#gs-casa-c.gs-casa-top,#gs-casa-c.gs-casa-mid{border-radius:6px 0 0 6px;bottom:30vh;height:96px;position:fixed;transform:translate(0,48px);width:92px}#gs-casa-b{width:72px}#gs-casa-f,#gs-casa-h{padding-left:3px}#gs-casa-f{border-radius:6px 0 0 0;font-size:14px;height:44px;line-height:44px}#gs-casa-h{border-radius:0 0 0 6px;font-size:9px;height:12px;line-height:12px}@keyframes gs-casa-a-l-ent{0%{transform:translate3d(72px,0,0)}100%{transform:translate3d(0,0,0)}}}';
                        document.head.appendChild(b);
                        c = new D(c, a);
                        setTimeout(c.s.bind(c), 1500)
                    }
                }
            }
        }
    }
    function J() {
        var a = y();
        if (0 == a.length) {
            var b = document;
            a = b.querySelectorAll("[itemscope][itemtype$=ScholarlyArticle] [itemprop=headline]");
            var c = 1 == a.length && x(a[0]);
            if (c) {
                a = b.querySelectorAll("[itemscope][itemtype$=ScholarlyArticle] [itemprop=author] [itemprop=name]");
                b = b.querySelectorAll("[itemscope][itemtype$=ScholarlyArticle] [itemprop=datePublished]");
                var e = [],
                    g = 0,
                    d;
                w("title", c + "", e);
                c = 0;
                for (var k = a.length; c < k; ++c)
                    if (d = x(a[c])) {
                        if (5 < ++g)
                            break;
                        w("author", d, e)
                    }
                1 == b.length && (d = x(b[0])) && w("publication_year",
                d, e);
                a = e
            } else
                a = []
        }
        a.push("url=" + encodeURIComponent(window.location.href));
        window.location.search.match(/[?&]casa_token=/i) ? d = !0 : (d = document.body, d = 39E5 <= Math.min(d.scrollWidth, 650) * d.scrollHeight ? !0 : !1);
        d && a.push("pdfonly");
        return "https://scholar.google.com/scholar_casa?" + a.join("&")
    }
    function K() {
        var a = new XMLHttpRequest;
        a.onload = I.bind(null, a);
        a.open("GET", J());
        a.withCredentials = !0;
        a.send()
    }
    "XMLHttpRequest" in window && "onload" in new XMLHttpRequest && "requestAnimationFrame" in window && !(0 <= (navigator.userAgent || "").indexOf("Trident/6.")) && ("loading" == document.readyState ? document.addEventListener("DOMContentLoaded", K) : K());
}).call(this);

