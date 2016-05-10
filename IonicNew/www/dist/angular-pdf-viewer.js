function delegateService(e) {
    return ["$log", function(t) {
        function n(e) {
            this.handle = e
        }
        var a = this,
            o = this._instances = [];
        this._registerInstance = function(e, t) {
            return e.$$delegateHandle = t, o.push(e),
                function() {
                    var t = o.indexOf(e); - 1 !== t && o.splice(t, 1)
                }
        }, this.$getByHandle = function(e) {
            return e ? new n(e) : a
        }, e.forEach(function(e) {
            n.prototype[e] = function() {
                var n, a, r = this.handle,
                    l = arguments,
                    u = 0;
                return o.forEach(function(t) {
                    t.$$delegateHandle === r && (u++, a = t[e].apply(t, l), 1 === u && (n = a))
                }), u ? n : t.warn('Delegate for handle "' + this.handle + '" could not find a corresponding element with delegate-handle="' + this.handle + '"! ' + e + "() was not called!\nPossible cause: If you are calling " + e + '() immediately, and your element with delegate-handle="' + this.handle + '" is a child of your controller, then your element may not be compiled yet. Put a $timeout around your call to ' + e + "() and try again.")
            }, a[e] = function() {
                var t, n, a = arguments;
                return o.forEach(function(o, r) {
                    n = o[e].apply(o, a), 0 === r && (t = n)
                }), t
            }
        })
    }]
}
angular.module("pdf", []).service("pdfDelegate", delegateService(["prev", "next", "zoomIn", "zoomOut", "zoomTo", "rotate", "getPageCount", "getCurrentPage", "goToPage", "load"])), angular.module("pdf").controller("PdfCtrl", ["$scope", "$element", "$attrs", "pdfDelegate", "$log", "$q", function(e, t, n, a, o, r) {
    var l = a._registerInstance(this, n.delegateHandle);
    e.$on("$destroy", l);
    var u, i = this,
        c = e.$eval(n.url),
        d = e.$eval(n.headers);
    e.pageCount = 0;
    var g = 1,
        s = 0,
        f = n.scale ? n.scale : 1,
        p = t.find("canvas")[0],
        h = p.getContext("2d"),
        m = function(e) {
            angular.isNumber(e) || (e = parseInt(e)), u.getPage(e).then(function(e) {
                var t = e.getViewport(f);
                p.height = t.height, p.width = t.width;
                var n = {
                    canvasContext: h,
                    viewport: t
                };
                e.render(n)
            })
        },
        v = function() {
            p.style.webkitTransform = "rotate(" + s + "deg)", p.style.MozTransform = "rotate(" + s + "deg)", p.style.msTransform = "rotate(" + s + "deg)", p.style.OTransform = "rotate(" + s + "deg)", p.style.transform = "rotate(" + s + "deg)"
        };
    i.prev = function() {
        1 >= g || (g = parseInt(g, 10) - 1, m(g))
    }, i.next = function() {
        g >= u.numPages || (g = parseInt(g, 10) + 1, m(g))
    }, i.zoomIn = function(e) {
        return e = e || .2, f = parseFloat(f) + e, m(g), f
    }, i.zoomOut = function(e) {
        return e = e || .2, f = parseFloat(f) - e, f = f > 0 ? f : .1, m(g), f
    }, i.zoomTo = function(e) {
        return e = e ? e : 1, f = parseFloat(e), m(g), f
    }, i.rotate = function() {
        s = 0 === s ? 90 : 90 === s ? 180 : 180 === s ? 270 : 0, v()
    }, i.getPageCount = function() {
        return e.pageCount
    }, i.getCurrentPage = function() {
        return g
    }, i.goToPage = function(e) {
        null !== u && (g = e, m(e))
    }, i.load = function(t) {
        t && (c = t);
        var n = {};
        return "string" == typeof c ? n.url = c : n.data = c, d && (n.httpHeaders = d), PDFJS.getDocument(n).then(function(t) {
            u = t, m(1), e.$apply(function() {
                e.pageCount = t.numPages
            })
        }, function(e) {
            return o.error(e), r.reject(e)
        })
    }, c && i.load()
}]), angular.module("pdf").directive("pdfViewerToolbar", ["pdfDelegate", function(e) {
    return {
        restrict: "E",
        scope: {
            pageCount: "="
        },
        link: function(t, n, a) {
            var o = a.delegateHandle;
            t.currentPage = 1, t.prev = function() {
                e.$getByHandle(o).prev(), r()
            }, t.next = function() {
                e.$getByHandle(o).next(), r()
            }, t.zoomIn = function() {
                e.$getByHandle(o).zoomIn()
            }, t.zoomOut = function() {
                e.$getByHandle(o).zoomOut()
            }, t.rotate = function() {
                e.$getByHandle(o).rotate()
            }, t.goToPage = function() {
                e.$getByHandle(o).goToPage(t.currentPage)
            };
            var r = function() {
                t.currentPage = e.$getByHandle(o).getCurrentPage()
            }
        }
    }
}]), angular.module("pdf").directive("pdfViewer", ["$window", "$log", "pdfDelegate", function() {
    return {
        restrict: "E",
        template: '<pdf-viewer-toolbar ng-if="showToolbar" delegate-handle="{{id}}" page-count="pageCount"></pdf-viewer-toolbar><canvas></canvas>',
        scope: !0,
        controller: "PdfCtrl",
        link: function(e, t, n) {
            e.id = n.delegateHandle, e.showToolbar = e.$eval(n.showToolbar) || !1
        }
    }
}]);
