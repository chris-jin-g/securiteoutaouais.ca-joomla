/*

FontSizer v2.2

Javascript to dynamically change font sizes on a web page.

Coded by Phil Nash of www.unintentionallyblank.co.uk

Cookies script courtesy of http://www.quirksmode.org/js/cookies.html

Measuring the current font size courtesy of http://www.alistapart.com/articles/fontresizing



** Please don't remove this notice **



See http://www.unintentionallyblank.co.uk/2007/11/09/fontsizer-reloaded-changing-font-sizes-with-javascript/ for full details



*/



addDOMLoadEvent = function() {
    var e, t, n, o, r, a = [],
        i = document,
        s = window,
        c = "readyState",
        d = "onreadystatechange",
        f = function() {
            for (n = 1, clearInterval(e); o = a.shift();) o();
            t && (t[d] = "")
        };
    return function(t) {
        return n ? t() : (a[0] || (i.addEventListener && i.addEventListener("DOMContentLoaded", f, !1), /WebKit/i.test(navigator.userAgent) && (e = setInterval(function() {
            /loaded|complete/.test(i[c]) && f()
        }, 10)), r = s.onload, s.onload = function() {
            f(), r && r()
        }), void a.push(t))
    }
}();
var s5_font_adjuster_src = "",
    s5_font_adjuster_scriptSource = function(e) {
        var e = document.getElementsByTagName("script"),
            t = e[e.length - 1];
        s5_font_adjuster_src = t.getAttribute("src", -1)
    }(),
    s5_font_adjuster_cookie_name = s5_font_adjuster_src;
if (s5_font_adjuster_src.indexOf("templates") > 0) {
    var s5_font_adjuster_src_array = s5_font_adjuster_src.split("templates");
    s5_font_adjuster_cookie_name = s5_font_adjuster_src_array[0]
} else if (s5_font_adjuster_src.indexOf("wp-content") > 0) {
    var s5_font_adjuster_src_array = s5_font_adjuster_src.split("wp-content");
    s5_font_adjuster_cookie_name = s5_font_adjuster_src_array[0]
}
var fS = {
    iFS: null,
    cFS: null,
    init: function(e) {
        if (document.getElementById && document.createTextNode) {
            if (UBCookie.read(s5_font_adjuster_cookie_name)) {
                var t = UBCookie.read(s5_font_adjuster_cookie_name).split(",");
                fS.iFS = 1 * t[0], fS.cFS = 1 * t[1], fS.setBodySize()
            } else {
                var n = document.createElement("span");
                n.innerHTML = "&nbsp;", n.style.position = "absolute", n.style.left = "-9999px", n.style.lineHeight = "1em", document.body.insertBefore(n, document.body.firstChild), fS.iFS = n.offsetHeight / 16, fS.cFS = fS.iFS, UBCookie.create(s5_font_adjuster_cookie_name, fS.iFS + "," + fS.cFS, 30)
            }
            fS.addJSLink(e, fS.decFS, "A", "decreaseSize"), fS.addJSLink(e, fS.rFS, "A", "resetSize"), fS.addJSLink(e, fS.incFS, "A", "increaseSize")
        }
    },
    incFS: function() {
        return fS.cFS = 1.1 * fS.cFS, fS.setBodySize(), !1
    },
    decFS: function() {
        return fS.cFS = .9 * fS.cFS, fS.setBodySize(), !1
    },
    rFS: function() {
        return fS.cFS = fS.iFS, fS.setBodySize(), !1
    },
    setBodySize: function() {
        document.body.style.fontSize = fS.cFS + "em", UBCookie.create(s5_font_adjuster_cookie_name, fS.iFS + "," + fS.cFS, 30)
    },
    addJSLink: function(e, t, n, o) {
        var r = document.getElementById(e),
            a = document.createElement("a");
        a.className = o;
        var n = document.createTextNode(n);
        if (r != null) {
            a.appendChild(n), a.onclick = t, a.href = "javascript:;" + e, r.appendChild(a)
        }
    }
},
UBCookie = {
    create: function(e, t, n) {
        if (n) {
            var o = new Date;
            o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
            var r = "; expires=" + o.toGMTString()
        } else var r = "";
        document.cookie = e + "=" + t + r + "; path=/"
    },
    read: function(e) {
        for (var t = e + "=", n = document.cookie.split(";"), o = 0; o < n.length; o++) {
            for (var r = n[o];
                " " == r.charAt(0);) r = r.substring(1, r.length);
            if (0 == r.indexOf(t)) return r.substring(t.length, r.length)
        }
        return null
    },
    erase: function(e) {
        createCookie(e, "", -1)
    }
};
addDOMLoadEvent(function() {
    fS.init("fontControls")
});