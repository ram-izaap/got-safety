/*!
 * elFinder - file manager for web
 * Version 2.0.6 (2016-02-21)
 * http://elfinder.org
 * 
 * Copyright 2009-2016, Studio 42
 * Licensed under a 3 clauses BSD license
 */
! function(e) {
    window.elFinder = function(t, n) {
            this.time("load");
            var i, r, a, o = this,
                t = e(t),
                s = e("<div/>").append(t.contents()),
                l = t.attr("style"),
                d = t.attr("id") || "",
                c = "elfinder-" + (d || Math.random().toString().substr(2, 7)),
                p = "mousedown." + c,
                u = "keydown." + c,
                h = "keypress." + c,
                f = !0,
                m = !0,
                g = "",
                v = {
                    path: "",
                    url: "",
                    tmbUrl: "",
                    disabled: [],
                    separator: "/",
                    archives: [],
                    extract: [],
                    copyOverwrite: !0,
                    tmb: !1
                },
                b = {},
                y = [],
                w = {},
                x = {},
                k = [],
                C = [],
                T = [],
                I = new o.command(o),
                F = "auto",
                P = 400,
                z = e(document.createElement("audio")).hide().appendTo("body")[0],
                A = function(t) {
                    if (t.init) b = {};
                    else
                        for (var n in b) b.hasOwnProperty(n) && "directory" != b[n].mime && b[n].phash == g && -1 === e.inArray(n, C) && delete b[n];
                    g = t.cwd.hash, O(t.files), b[g] || O([t.cwd]), o.lastDir(g)
                },
                O = function(e) {
                    for (var t, n = e.length; n--;)
                        if (t = e[n], t.name && t.hash && t.mime) {
                            if (!t.phash) {
                                var i = "volume_" + t.name,
                                    r = o.i18n(i);
                                i != r && (t.i18 = r)
                            }
                            b[t.hash] = t
                        }
                },
                D = function(t) {
                    var n = t.keyCode,
                        i = !(!t.ctrlKey && !t.metaKey);
                    f && (e.each(x, function(e, r) {
                        r.type == t.type && r.keyCode == n && r.shiftKey == t.shiftKey && r.ctrlKey == i && r.altKey == t.altKey && (t.preventDefault(), t.stopPropagation(), r.callback(t, o), o.debug("shortcut-exec", e + " : " + r.description))
                    }), 9 != n || e(t.target).is(":input") || t.preventDefault())
                },
                M = new Date;
            return this.api = null, this.newAPI = !1, this.oldAPI = !1, this.netDrivers = [], this.OS = -1 !== navigator.userAgent.indexOf("Mac") ? "mac" : -1 !== navigator.userAgent.indexOf("Win") ? "win" : "other", this.UA = function() {
                var e = !document.uniqueID && !window.opera && !window.sidebar && window.localStorage && "undefined" == typeof window.orientation;
                return {
                    ltIE6: "undefined" == typeof window.addEventListener && "undefined" == typeof document.documentElement.style.maxHeight,
                    ltIE7: "undefined" == typeof window.addEventListener && "undefined" == typeof document.querySelectorAll,
                    ltIE8: "undefined" == typeof window.addEventListener && "undefined" == typeof document.getElementsByClassName,
                    IE: document.uniqueID,
                    Firefox: window.sidebar,
                    Opera: window.opera,
                    Webkit: e,
                    Chrome: e && window.chrome,
                    Safari: e && !window.chrome,
                    Mobile: "undefined" != typeof window.orientation
                }
            }(), this.options = e.extend(!0, {}, this._options, n || {}), n.ui && (this.options.ui = n.ui), n.commands && (this.options.commands = n.commands), n.uiOptions && n.uiOptions.toolbar && (this.options.uiOptions.toolbar = n.uiOptions.toolbar), e.extend(this.options.contextmenu, n.contextmenu), this.requestType = /^(get|post)$/i.test(this.options.requestType) ? this.options.requestType.toLowerCase() : "get", this.customData = e.isPlainObject(this.options.customData) ? this.options.customData : {}, this.id = d, this.uploadURL = n.urlUpload || n.url, this.namespace = c, this.lang = this.i18[this.options.lang] && this.i18[this.options.lang].messages ? this.options.lang : "en", a = "en" == this.lang ? this.i18.en : e.extend(!0, {}, this.i18.en, this.i18[this.lang]), this.direction = a.direction, this.messages = a.messages, this.dateFormat = this.options.dateFormat || a.dateFormat, this.fancyFormat = this.options.fancyDateFormat || a.fancyDateFormat, this.today = new Date(M.getFullYear(), M.getMonth(), M.getDate()).getTime() / 1e3, this.yesterday = this.today - 86400, r = this.options.UTCDate ? "UTC" : "", this.getHours = "get" + r + "Hours", this.getMinutes = "get" + r + "Minutes", this.getSeconds = "get" + r + "Seconds", this.getDate = "get" + r + "Date", this.getDay = "get" + r + "Day", this.getMonth = "get" + r + "Month", this.getFullYear = "get" + r + "FullYear", this.cssClass = "ui-helper-reset ui-helper-clearfix ui-widget ui-widget-content ui-corner-all elfinder elfinder-" + ("rtl" == this.direction ? "rtl" : "ltr") + " " + this.options.cssClass, this.storage = function() {
                try {
                    return "localStorage" in window && null !== window.localStorage ? o.localStorage : o.cookie
                } catch (e) {
                    return o.cookie
                }
            }(), this.viewType = this.storage("view") || this.options.defaultView || "icons", this.sortType = this.storage("sortType") || this.options.sortType || "name", this.sortOrder = this.storage("sortOrder") || this.options.sortOrder || "asc", this.sortStickFolders = this.storage("sortStickFolders"), this.sortStickFolders = null === this.sortStickFolders ? !!this.options.sortStickFolders : !!this.sortStickFolders, this.sortRules = e.extend(!0, {}, this._sortRules, this.options.sortsRules), e.each(this.sortRules, function(e, t) {
                "function" != typeof t && delete o.sortRules[e]
            }), this.compare = e.proxy(this.compare, this), this.notifyDelay = this.options.notifyDelay > 0 ? parseInt(this.options.notifyDelay) : 500, this.draggingUiHelper = null, this.draggable = {
                appendTo: "body",
                addClasses: !0,
                delay: 30,
                distance: 8,
                revert: !0,
                refreshPositions: !0,
                cursor: "move",
                cursorAt: {
                    left: 50,
                    top: 47
                },
                start: function(t, n) {
                    var i, r, a = e.map(n.helper.data("files") || [], function(e) {
                        return e || null
                    });
                    for (o.draggingUiHelper = n.helper, i = a.length; i--;)
                        if (r = a[i], b[r].locked) {
                            n.helper.addClass("elfinder-drag-helper-plus").data("locked", !0);
                            break
                        }
                },
                stop: function() {
                    o.draggingUiHelper = null, o.trigger("focus").trigger("dragstop")
                },
                helper: function(t) {
                    var n, i, r = this.id ? e(this) : e(this).parents("[id]:first"),
                        a = e('<div class="elfinder-drag-helper"><span class="elfinder-drag-helper-icon-plus"/></div>'),
                        s = function(e) {
                            return '<div class="elfinder-cwd-icon ' + o.mime2class(e) + ' ui-corner-all"/>'
                        };
                    return o.draggingUiHelper && o.draggingUiHelper.stop(!0, !0), o.trigger("dragstart", {
                        target: r[0],
                        originalEvent: t
                    }), n = r.is("." + o.res("class", "cwdfile")) ? o.selected() : [o.navId2Hash(r.attr("id"))], a.append(s(b[n[0]].mime)).data("files", n).data("locked", !1), (i = n.length) > 1 && a.append(s(b[n[i - 1]].mime) + '<span class="elfinder-drag-num">' + i + "</span>"), e(document).bind(u + " keyup." + c, function(e) {
                        a.is(":visible") && !a.data("locked") && a.toggleClass("elfinder-drag-helper-plus", e.shiftKey || e.ctrlKey || e.metaKey)
                    }), a
                }
            }, this.droppable = {
                tolerance: "pointer",
                accept: ".elfinder-cwd-file-wrapper,.elfinder-navbar-dir,.elfinder-cwd-file",
                hoverClass: this.res("class", "adroppable"),
                drop: function(t, n) {
                    var i, r, a, s = e(this),
                        l = e.map(n.helper.data("files") || [], function(e) {
                            return e || null
                        }),
                        d = [],
                        c = "class";
                    for (s.is("." + o.res(c, "cwd")) ? r = g : s.is("." + o.res(c, "cwdfile")) ? r = s.attr("id") : s.is("." + o.res(c, "navdir")) && (r = o.navId2Hash(s.attr("id"))), i = l.length; i--;) a = l[i], a != r && b[a].phash != r && d.push(a);
                    d.length && (n.helper.hide(), o.clipboard(d, !(t.ctrlKey || t.shiftKey || t.metaKey || n.helper.data("locked"))), o.exec("paste", r), o.trigger("drop", {
                        files: l
                    }))
                }
            }, this.enabled = function() {
                return t.is(":visible") && f
            }, this.visible = function() {
                return t.is(":visible")
            }, this.root = function(e) {
                for (var t, n = b[e || g]; n && n.phash;) n = b[n.phash];
                if (n) return n.hash;
                for (; t in b && b.hasOwnProperty(t);)
                    if (n = b[t], !n.phash && "directory" == !n.mime && n.read) return n.hash;
                return ""
            }, this.cwd = function() {
                return b[g] || {}
            }, this.option = function(e) {
                return v[e] || ""
            }, this.file = function(e) {
                return b[e]
            }, this.files = function() {
                return e.extend(!0, {}, b)
            }, this.parents = function(e) {
                for (var t, n = []; t = this.file(e);) n.unshift(t.hash), e = t.phash;
                return n
            }, this.path2array = function(e, t) {
                for (var n, i = []; e && (n = b[e]) && n.hash;) i.unshift(t && n.i18 ? n.i18 : n.name), e = n.phash;
                return i
            }, this.path = function(e, t) {
                return b[e] && b[e].path ? b[e].path : this.path2array(e, t).join(v.separator)
            }, this.url = function(t) {
                var n = b[t];
                if (!n || !n.read) return "";
                if (n.url) return n.url;
                if (v.url) return v.url + e.map(this.path2array(t), function(e) {
                    return encodeURIComponent(e)
                }).slice(1).join("/");
                var i = e.extend({}, this.customData, {
                    cmd: "file",
                    target: n.hash
                });
                return this.oldAPI && (i.cmd = "open", i.current = n.phash), this.options.url + (-1 === this.options.url.indexOf("?") ? "?" : "&") + e.param(i, !0)
            }, this.tmb = function(e) {
                var t = b[e],
                    n = t && t.tmb && 1 != t.tmb ? v.tmbUrl + t.tmb : "";
                return n && (this.UA.Opera || this.UA.IE) && (n += "?_=" + (new Date).getTime()), n
            }, this.selected = function() {
                return y.slice(0)
            }, this.selectedFiles = function() {
                return e.map(y, function(t) {
                    return b[t] ? e.extend({}, b[t]) : null
                })
            }, this.fileByName = function(e, t) {
                var n;
                for (n in b)
                    if (b.hasOwnProperty(n) && b[n].phash == t && b[n].name == e) return b[n]
            }, this.validResponse = function(e, t) {
                return t.error || this.rules[this.rules[e] ? e : "defaults"](t)
            }, this.request = function(t) {
                var n, i, r, a = this,
                    o = this.options,
                    s = e.Deferred(),
                    l = e.extend({}, o.customData, {
                        mimes: o.onlyMimes
                    }, t.data || t),
                    d = l.cmd,
                    c = !(t.preventDefault || t.preventFail),
                    p = !(t.preventDefault || t.preventDone),
                    u = e.extend({}, t.notify),
                    h = !!t.raw,
                    f = t.syncOnFail,
                    t = e.extend({
                        url: o.url,
                        async: !0,
                        type: this.requestType,
                        dataType: "json",
                        cache: !1,
                        data: l
                    }, t.options || {}),
                    m = function(t) {
                        t.warning && a.error(t.warning), "open" == d && A(e.extend(!0, {}, t)), t.removed && t.removed.length && a.remove(t), t.added && t.added.length && a.add(t), t.changed && t.changed.length && a.change(t), a.trigger(d, t), t.sync && a.sync()
                    },
                    g = function(e, t) {
                        var n;
                        switch (t) {
                            case "abort":
                                n = e.quiet ? "" : ["errConnect", "errAbort"];
                                break;
                            case "timeout":
                                n = ["errConnect", "errTimeout"];
                                break;
                            case "parsererror":
                                n = ["errResponse", "errDataNotJSON"];
                                break;
                            default:
                                n = 403 == e.status ? ["errConnect", "errAccess"] : 404 == e.status ? ["errConnect", "errNotFound"] : "errConnect"
                        }
                        s.reject(n, e, t)
                    },
                    b = function(t) {
                        return h ? s.resolve(t) : t ? e.isPlainObject(t) ? t.error ? s.reject(t.error, i) : a.validResponse(d, t) ? (t = a.normalize(t), a.api || (a.api = t.api || 1, a.newAPI = a.api >= 2, a.oldAPI = !a.newAPI), t.options && (v = e.extend({}, v, t.options)), t.netDrivers && (a.netDrivers = t.netDrivers), s.resolve(t), t.debug && a.debug("backend-debug", t.debug), void 0) : s.reject("errResponse", i) : s.reject(["errResponse", "errDataNotJSON"], i) : s.reject(["errResponse", "errDataEmpty"], i)
                    };
                if (p && s.done(m), s.fail(function(e) {
                        e && (c ? a.error(e) : a.debug("error", a.i18n(e)))
                    }), !d) return s.reject("errCmdReq");
                if (f && s.fail(function(e) {
                        e && a.sync()
                    }), u.type && u.cnt && (n = setTimeout(function() {
                        a.notify(u), s.always(function() {
                            u.cnt = -(parseInt(u.cnt) || 0), a.notify(u)
                        })
                    }, a.notifyDelay), s.always(function() {
                        clearTimeout(n)
                    })), "open" == d)
                    for (; r = T.pop();) "pending" == r.state() && (r.quiet = !0, r.abort());
                return delete t.preventFail, i = this.transport.send(t).fail(g).done(b), "open" == d && (T.unshift(i), s.always(function() {
                    var t = e.inArray(i, T); - 1 !== t && T.splice(t, 1)
                })), s
            }, this.diff = function(t) {
                var n = {},
                    i = [],
                    r = [],
                    a = [],
                    o = function(e) {
                        for (var t = a.length; t--;)
                            if (a[t].hash == e) return !0
                    };
                return e.each(t, function(e, t) {
                    n[t.hash] = t
                }), e.each(b, function(e) {
                    !n[e] && r.push(e)
                }), e.each(n, function(t, n) {
                    var r = b[t];
                    r ? e.each(n, function(e) {
                        return n[e] != r[e] ? (a.push(n), !1) : void 0
                    }) : i.push(n)
                }), e.each(r, function(t, i) {
                    var s = b[i],
                        l = s.phash;
                    l && "directory" == s.mime && -1 === e.inArray(l, r) && n[l] && !o(l) && a.push(n[l])
                }), {
                    added: i,
                    removed: r,
                    changed: a
                }
            }, this.sync = function() {
                var t = this,
                    n = e.Deferred().done(function() {
                        t.trigger("sync")
                    }),
                    i = {
                        data: {
                            cmd: "open",
                            init: 1,
                            target: g,
                            tree: this.ui.tree ? 1 : 0
                        },
                        preventDefault: !0
                    },
                    r = {
                        data: {
                            cmd: "tree",
                            target: g == this.root() ? g : this.file(g).phash
                        },
                        preventDefault: !0
                    };
                return e.when(this.request(i), this.request(r)).fail(function(e) {
                    n.reject(e), e && t.request({
                        data: {
                            cmd: "open",
                            target: t.lastDir(""),
                            tree: 1,
                            init: 1
                        },
                        notify: {
                            type: "open",
                            cnt: 1,
                            hideCnt: !0
                        },
                        preventDefault: !0
                    })
                }).done(function(e, i) {
                    var r = t.diff(e.files.concat(i && i.tree ? i.tree : []));
                    return r.added.push(e.cwd), r.removed.length && t.remove(r), r.added.length && t.add(r), r.changed.length && t.change(r), n.resolve(r)
                }), n
            }, this.upload = function(e) {
                return this.transport.upload(e, this)
            }, this.bind = function(e, t) {
                var n;
                if ("function" == typeof t)
                    for (e = ("" + e).toLowerCase().split(/\s+/), n = 0; n < e.length; n++) void 0 === w[e[n]] && (w[e[n]] = []), w[e[n]].push(t);
                return this
            }, this.unbind = function(t, n) {
                var i = w[("" + t).toLowerCase()] || [],
                    r = e.inArray(n, i);
                return r > -1 && i.splice(r, 1), n = null, this
            }, this.trigger = function(t, n) {
                var i, t = t.toLowerCase(),
                    r = w[t] || [];
                if (this.debug("event-" + t, n), r.length)
                    for (t = e.Event(t), i = 0; i < r.length; i++) {
                        t.data = e.extend(!0, {}, n);
                        try {
                            if (r[i](t, this) === !1 || t.isDefaultPrevented()) {
                                this.debug("event-stoped", t.type);
                                break
                            }
                        } catch (a) {
                            window.console && window.console.log && window.console.log(a)
                        }
                    }
                return this
            }, this.shortcut = function(t) {
                var n, i, r, a, o;
                if (this.options.allowShortcuts && t.pattern && e.isFunction(t.callback))
                    for (n = t.pattern.toUpperCase().split(/\s+/), a = 0; a < n.length; a++) i = n[a], o = i.split("+"), r = 1 == (r = o.pop()).length ? r > 0 ? r : r.charCodeAt(0) : e.ui.keyCode[r], r && !x[i] && (x[i] = {
                        keyCode: r,
                        altKey: -1 != e.inArray("ALT", o),
                        ctrlKey: -1 != e.inArray("CTRL", o),
                        shiftKey: -1 != e.inArray("SHIFT", o),
                        type: t.type || "keydown",
                        callback: t.callback,
                        description: t.description,
                        pattern: i
                    });
                return this
            }, this.shortcuts = function() {
                var t = [];
                return e.each(x, function(e, n) {
                    t.push([n.pattern, o.i18n(n.description)])
                }), t
            }, this.clipboard = function(t, n) {
                var i = function() {
                    return e.map(k, function(e) {
                        return e.hash
                    })
                };
                return void 0 !== t && (k.length && this.trigger("unlockfiles", {
                    files: i()
                }), C = [], k = e.map(t || [], function(e) {
                    var t = b[e];
                    return t ? (C.push(e), {
                        hash: e,
                        phash: t.phash,
                        name: t.name,
                        mime: t.mime,
                        read: t.read,
                        locked: t.locked,
                        cut: !!n
                    }) : null
                }), this.trigger("changeclipboard", {
                    clipboard: k.slice(0, k.length)
                }), n && this.trigger("lockfiles", {
                    files: i()
                })), k.slice(0, k.length)
            }, this.isCommandEnabled = function(t) {
                return this._commands[t] ? -1 === e.inArray(t, v.disabled) : !1
            }, this.exec = function(t, n, i) {
                return this._commands[t] && this.isCommandEnabled(t) ? this._commands[t].exec(n, i) : e.Deferred().reject("No such command")
            }, this.dialog = function(n, i) {
                return e("<div/>").append(n).appendTo(t).elfinderdialog(i)
            }, this.getUI = function(e) {
                return this.ui[e] || t
            }, this.command = function(e) {
                return void 0 === e ? this._commands : this._commands[e]
            }, this.resize = function(e, n) {
                t.css("width", e).height(n).trigger("resize"), this.trigger("resize", {
                    width: t.width(),
                    height: t.height()
                })
            }, this.restoreSize = function() {
                this.resize(F, P)
            }, this.show = function() {
                t.show(), this.enable().trigger("show")
            }, this.hide = function() {
                this.disable().trigger("hide"), t.hide()
            }, this.destroy = function() {
                t && t[0].elfinder && (this.trigger("destroy").disable(), w = {}, x = {}, e(document).add(t).unbind("." + this.namespace), o.trigger = function() {}, t.children().remove(), t.append(s.contents()).removeClass(this.cssClass).attr("style", l), t[0].elfinder = null, i && clearInterval(i))
            }, e.fn.selectable && e.fn.draggable && e.fn.droppable ? t.length ? this.options.url ? (e.extend(e.ui.keyCode, {
                F1: 112,
                F2: 113,
                F3: 114,
                F4: 115,
                F5: 116,
                F6: 117,
                F7: 118,
                F8: 119,
                F9: 120
            }), this.dragUpload = !1, this.xhrUpload = ("undefined" != typeof XMLHttpRequestUpload || "undefined" != typeof XMLHttpRequestEventTarget) && "undefined" != typeof File && "undefined" != typeof FormData, this.transport = {}, "object" == typeof this.options.transport && (this.transport = this.options.transport, "function" == typeof this.transport.init && this.transport.init(this)), "function" != typeof this.transport.send && (this.transport.send = function(t) {
                return e.ajax(t)
            }), "iframe" == this.transport.upload ? this.transport.upload = e.proxy(this.uploads.iframe, this) : "function" == typeof this.transport.upload ? this.dragUpload = !!this.options.dragUploadAllow : this.xhrUpload && this.options.dragUploadAllow ? (this.transport.upload = e.proxy(this.uploads.xhr, this), this.dragUpload = !0) : this.transport.upload = e.proxy(this.uploads.iframe, this), this.error = function() {
                var e = arguments[0];
                return 1 == arguments.length && "function" == typeof e ? o.bind("error", e) : o.trigger("error", {
                    error: e
                })
            }, e.each(["enable", "disable", "load", "open", "reload", "select", "add", "remove", "change", "dblclick", "getfile", "lockfiles", "unlockfiles", "dragstart", "dragstop", "search", "searchend", "viewchange"], function(t, n) {
                o[n] = function() {
                    var t = arguments[0];
                    return 1 == arguments.length && "function" == typeof t ? o.bind(n, t) : o.trigger(n, e.isPlainObject(t) ? t : {})
                }
            }), this.enable(function() {
                !f && o.visible() && o.ui.overlay.is(":hidden") && (f = !0, e("texarea:focus,input:focus,button").blur(), t.removeClass("elfinder-disabled"))
            }).disable(function() {
                m = f, f = !1, t.addClass("elfinder-disabled")
            }).open(function() {
                y = []
            }).select(function(t) {
                y = e.map(t.data.selected || t.data.value || [], function(e) {
                    return b[e] ? e : null
                })
            }).error(function(t) {
                var n = {
                    cssClass: "elfinder-dialog-error",
                    title: o.i18n(o.i18n("error")),
                    resizable: !1,
                    destroyOnClose: !0,
                    buttons: {}
                };
                n.buttons[o.i18n(o.i18n("btnClose"))] = function() {
                    e(this).elfinderdialog("close")
                }, o.dialog('<span class="elfinder-dialog-icon elfinder-dialog-icon-error"/>' + o.i18n(t.data.error), n)
            }).bind("tree parents", function(e) {
                O(e.data.tree || [])
            }).bind("tmb", function(t) {
                e.each(t.data.images || [], function(e, t) {
                    b[e] && (b[e].tmb = t)
                })
            }).add(function(e) {
                O(e.data.added || [])
            }).change(function(t) {
                e.each(t.data.changed || [], function(t, n) {
                    var i = n.hash;
                    (b[i].width && !n.width || b[i].height && !n.height) && (b[i].width = void 0, b[i].height = void 0), b[i] = b[i] ? e.extend(b[i], n) : n
                })
            }).remove(function(t) {
                for (var n = t.data.removed || [], i = n.length, r = function(t) {
                        var n = b[t];
                        n && ("directory" == n.mime && n.dirs && e.each(b, function(e, n) {
                            n.phash == t && r(e)
                        }), delete b[t])
                    }; i--;) r(n[i])
            }).bind("search", function(e) {
                O(e.data.files)
            }).bind("rm", function() {
                var t = z.canPlayType && z.canPlayType('audio/wav; codecs="1"');
                t && "" != t && "no" != t && e(z).html('<source src="./sounds/rm.wav" type="audio/wav">')[0].play()
            }), e.each(this.options.handlers, function(e, t) {
                o.bind(e, t)
            }), this.history = new this.history(this), "function" == typeof this.options.getFileCallback && this.commands.getfile && (this.bind("dblclick", function(e) {
                e.preventDefault(), o.exec("getfile").fail(function() {
                    o.exec("open")
                })
            }), this.shortcut({
                pattern: "enter",
                description: this.i18n("cmdgetfile"),
                callback: function() {
                    o.exec("getfile").fail(function() {
                        o.exec("mac" == o.OS ? "rename" : "open")
                    })
                }
            }).shortcut({
                pattern: "ctrl+enter",
                description: this.i18n("mac" == this.OS ? "cmdrename" : "cmdopen"),
                callback: function() {
                    o.exec("mac" == o.OS ? "rename" : "open")
                }
            })), this._commands = {}, e.isArray(this.options.commands) || (this.options.commands = []), e.each(["open", "reload", "back", "forward", "up", "home", "info", "quicklook", "getfile", "help"], function(t, n) {
                -1 === e.inArray(n, o.options.commands) && o.options.commands.push(n)
            }), e.each(this.options.commands, function(t, n) {
                var i = o.commands[n];
                e.isFunction(i) && !o._commands[n] && (i.prototype = I, o._commands[n] = new i, o._commands[n].setup(n, o.options.commandsOptions[n] || {}))
            }), t.addClass(this.cssClass).bind(p, function() {
                !f && o.enable()
            }), this.ui = {
                workzone: e("<div/>").appendTo(t).elfinderworkzone(this),
                navbar: e("<div/>").appendTo(t).elfindernavbar(this, this.options.uiOptions.navbar || {}),
                contextmenu: e("<div/>").appendTo(t).elfindercontextmenu(this),
                overlay: e("<div/>").appendTo(t).elfinderoverlay({
                    show: function() {
                        o.disable()
                    },
                    hide: function() {
                        m && o.enable()
                    }
                }),
                cwd: e("<div/>").appendTo(t).elfindercwd(this, this.options.uiOptions.cwd || {}),
                notify: this.dialog("", {
                    cssClass: "elfinder-dialog-notify",
                    position: {
                        top: "12px",
                        right: "12px"
                    },
                    resizable: !1,
                    autoOpen: !1,
                    title: "&nbsp;",
                    width: 280
                }),
                statusbar: e('<div class="ui-widget-header ui-helper-clearfix ui-corner-bottom elfinder-statusbar"/>').hide().appendTo(t)
            }, e.each(this.options.ui || [], function(n, i) {
                var r = "elfinder" + i,
                    a = o.options.uiOptions[i] || {};
                !o.ui[i] && e.fn[r] && (o.ui[i] = e("<" + (a.tag || "div") + "/>").appendTo(t)[r](o, a))
            }), t[0].elfinder = this, this.options.resizable && e.fn.resizable && t.resizable({
                handles: "se",
                minWidth: 300,
                minHeight: 200
            }), this.options.width && (F = this.options.width), this.options.height && (P = parseInt(this.options.height)), o.resize(F, P), e(document).bind("click." + this.namespace, function(n) {
                f && !e(n.target).closest(t).length && o.disable()
            }).bind(u + " " + h, D), o.options.useBrowserHistory && e(window).on("popstate", function(t) {
                var n = t.originalEvent.state && t.originalEvent.state.thash;
                n && !e.isEmptyObject(o.files()) && o.request({
                    data: {
                        cmd: "open",
                        target: n,
                        onhistory: 1
                    },
                    notify: {
                        type: "open",
                        cnt: 1,
                        hideCnt: !0
                    },
                    syncOnFail: !0
                })
            }), this.trigger("init").request({
                data: {
                    cmd: "open",
                    target: o.startDir(),
                    init: 1,
                    tree: this.ui.tree ? 1 : 0
                },
                preventDone: !0,
                notify: {
                    type: "open",
                    cnt: 1,
                    hideCnt: !0
                },
                freeze: !0
            }).fail(function() {
                o.trigger("fail").disable().lastDir(""), w = {}, x = {}, e(document).add(t).unbind("." + this.namespace), o.trigger = function() {}
            }).done(function(t) {
                o.load().debug("api", o.api), t = e.extend(!0, {}, t), A(t), o.trigger("open", t)
            }), this.one("load", function() {
                t.trigger("resize"), o.options.sync > 1e3 && (i = setInterval(function() {
                    o.sync()
                }, o.options.sync))
            }), void 0) : alert(this.i18n("errURL")) : alert(this.i18n("errNode")) : alert(this.i18n("errJqui"))
        }, elFinder.prototype = {
            res: function(e, t) {
                return this.resources[e] && this.resources[e][t]
            },
            i18: {
                en: {
                    translator: "",
                    language: "English",
                    direction: "ltr",
                    dateFormat: "d.m.Y H:i",
                    fancyDateFormat: "$1 H:i",
                    messages: {}
                },
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthsShort: ["msJan", "msFeb", "msMar", "msApr", "msMay", "msJun", "msJul", "msAug", "msSep", "msOct", "msNov", "msDec"],
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
            },
            kinds: {
                unknown: "Unknown",
                directory: "Folder",
                symlink: "Alias",
                "symlink-broken": "AliasBroken",
                "application/x-empty": "TextPlain",
                "application/postscript": "Postscript",
                "application/vnd.ms-office": "MsOffice",
                "application/vnd.ms-word": "MsWord",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document": "MsWord",
                "application/vnd.ms-word.document.macroEnabled.12": "MsWord",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.template": "MsWord",
                "application/vnd.ms-word.template.macroEnabled.12": "MsWord",
                "application/vnd.ms-excel": "MsExcel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": "MsExcel",
                "application/vnd.ms-excel.sheet.macroEnabled.12": "MsExcel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.template": "MsExcel",
                "application/vnd.ms-excel.template.macroEnabled.12": "MsExcel",
                "application/vnd.ms-excel.sheet.binary.macroEnabled.12": "MsExcel",
                "application/vnd.ms-excel.addin.macroEnabled.12": "MsExcel",
                "application/vnd.ms-powerpoint": "MsPP",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation": "MsPP",
                "application/vnd.ms-powerpoint.presentation.macroEnabled.12": "MsPP",
                "application/vnd.openxmlformats-officedocument.presentationml.slideshow": "MsPP",
                "application/vnd.ms-powerpoint.slideshow.macroEnabled.12": "MsPP",
                "application/vnd.openxmlformats-officedocument.presentationml.template": "MsPP",
                "application/vnd.ms-powerpoint.template.macroEnabled.12": "MsPP",
                "application/vnd.ms-powerpoint.addin.macroEnabled.12": "MsPP",
                "application/vnd.openxmlformats-officedocument.presentationml.slide": "MsPP",
                "application/vnd.ms-powerpoint.slide.macroEnabled.12": "MsPP",
                "application/pdf": "PDF",
                "application/xml": "XML",
                "application/vnd.oasis.opendocument.text": "OO",
                "application/vnd.oasis.opendocument.text-template": "OO",
                "application/vnd.oasis.opendocument.text-web": "OO",
                "application/vnd.oasis.opendocument.text-master": "OO",
                "application/vnd.oasis.opendocument.graphics": "OO",
                "application/vnd.oasis.opendocument.graphics-template": "OO",
                "application/vnd.oasis.opendocument.presentation": "OO",
                "application/vnd.oasis.opendocument.presentation-template": "OO",
                "application/vnd.oasis.opendocument.spreadsheet": "OO",
                "application/vnd.oasis.opendocument.spreadsheet-template": "OO",
                "application/vnd.oasis.opendocument.chart": "OO",
                "application/vnd.oasis.opendocument.formula": "OO",
                "application/vnd.oasis.opendocument.database": "OO",
                "application/vnd.oasis.opendocument.image": "OO",
                "application/vnd.openofficeorg.extension": "OO",
                "application/x-shockwave-flash": "AppFlash",
                "application/flash-video": "Flash video",
                "application/x-bittorrent": "Torrent",
                "application/javascript": "JS",
                "application/rtf": "RTF",
                "application/rtfd": "RTF",
                "application/x-font-ttf": "TTF",
                "application/x-font-otf": "OTF",
                "application/x-rpm": "RPM",
                "application/x-web-config": "TextPlain",
                "application/xhtml+xml": "HTML",
                "application/docbook+xml": "DOCBOOK",
                "application/x-awk": "AWK",
                "application/x-gzip": "GZIP",
                "application/x-bzip2": "BZIP",
                "application/x-xz": "XZ",
                "application/zip": "ZIP",
                "application/x-zip": "ZIP",
                "application/x-rar": "RAR",
                "application/x-tar": "TAR",
                "application/x-7z-compressed": "7z",
                "application/x-jar": "JAR",
                "text/plain": "TextPlain",
                "text/x-php": "PHP",
                "text/html": "HTML",
                "text/javascript": "JS",
                "text/css": "CSS",
                "text/rtf": "RTF",
                "text/rtfd": "RTF",
                "text/x-c": "C",
                "text/x-csrc": "C",
                "text/x-chdr": "CHeader",
                "text/x-c++": "CPP",
                "text/x-c++src": "CPP",
                "text/x-c++hdr": "CPPHeader",
                "text/x-shellscript": "Shell",
                "application/x-csh": "Shell",
                "text/x-python": "Python",
                "text/x-java": "Java",
                "text/x-java-source": "Java",
                "text/x-ruby": "Ruby",
                "text/x-perl": "Perl",
                "text/x-sql": "SQL",
                "text/xml": "XML",
                "text/x-comma-separated-values": "CSV",
                "image/x-ms-bmp": "BMP",
                "image/jpeg": "JPEG",
                "image/gif": "GIF",
                "image/png": "PNG",
                "image/tiff": "TIFF",
                "image/x-targa": "TGA",
                "image/vnd.adobe.photoshop": "PSD",
                "image/xbm": "XBITMAP",
                "image/pxm": "PXM",
                "audio/mpeg": "AudioMPEG",
                "audio/midi": "AudioMIDI",
                "audio/ogg": "AudioOGG",
                "audio/mp4": "AudioMPEG4",
                "audio/x-m4a": "AudioMPEG4",
                "audio/wav": "AudioWAV",
                "audio/x-mp3-playlist": "AudioPlaylist",
                "video/x-dv": "VideoDV",
                "video/mp4": "VideoMPEG4",
                "video/mpeg": "VideoMPEG",
                "video/x-msvideo": "VideoAVI",
                "video/quicktime": "VideoMOV",
                "video/x-ms-wmv": "VideoWM",
                "video/x-flv": "VideoFlash",
                "video/x-matroska": "VideoMKV",
                "video/ogg": "VideoOGG"
            },
            rules: {
                defaults: function(t) {
                    return !t || t.added && !e.isArray(t.added) || t.removed && !e.isArray(t.removed) || t.changed && !e.isArray(t.changed) ? !1 : !0
                },
                open: function(t) {
                    return t && t.cwd && t.files && e.isPlainObject(t.cwd) && e.isArray(t.files)
                },
                tree: function(t) {
                    return t && t.tree && e.isArray(t.tree)
                },
                parents: function(t) {
                    return t && t.tree && e.isArray(t.tree)
                },
                tmb: function(t) {
                    return t && t.images && (e.isPlainObject(t.images) || e.isArray(t.images))
                },
                upload: function(t) {
                    return t && (e.isPlainObject(t.added) || e.isArray(t.added))
                },
                search: function(t) {
                    return t && t.files && e.isArray(t.files)
                }
            },
            commands: {},
            parseUploadData: function(t) {
                var n;
                if (!e.trim(t)) return {
                    error: ["errResponse", "errDataEmpty"]
                };
                try {
                    n = e.parseJSON(t)
                } catch (i) {
                    return {
                        error: ["errResponse", "errDataNotJSON"]
                    }
                }
                return this.validResponse("upload", n) ? (n = this.normalize(n), n.removed = e.map(n.added || [], function(e) {
                    return e.hash
                }), n) : {
                    error: ["errResponse"]
                }
            },
            iframeCnt: 0,
            uploads: {
                iframe: function(t, n) {
                    var i, r, a, o, s = n ? n : this,
                        l = t.input,
                        d = e.Deferred().fail(function(e) {
                            e && s.error(e)
                        }).done(function(e) {
                            e.warning && s.error(e.warning), e.removed && s.remove(e), e.added && s.add(e), e.changed && s.change(e), s.trigger("upload", e), e.sync && s.sync()
                        }),
                        c = "iframe-" + s.namespace + ++s.iframeCnt,
                        p = e('<form action="' + s.uploadURL + '" method="post" enctype="multipart/form-data" encoding="multipart/form-data" target="' + c + '" style="display:none"><input type="hidden" name="cmd" value="upload" /></form>'),
                        u = this.UA.IE,
                        h = function() {
                            o && clearTimeout(o), a && clearTimeout(a), r && s.notify({
                                type: "upload",
                                cnt: -i
                            }), setTimeout(function() {
                                u && e('<iframe src="javascript:false;"/>').appendTo(p), p.remove(), f.remove()
                            }, 100)
                        },
                        f = e('<iframe src="' + (u ? "javascript:false;" : "about:blank") + '" name="' + c + '" style="position:absolute;left:-1000px;top:-1000px" />').bind("load", function() {
                            f.unbind("load").bind("load", function() {
                                var e = s.parseUploadData(f.contents().text());
                                h(), e.error ? d.reject(e.error) : d.resolve(e)
                            }), a = setTimeout(function() {
                                r = !0, s.notify({
                                    type: "upload",
                                    cnt: i
                                })
                            }, s.options.notifyDelay), s.options.iframeTimeout > 0 && (o = setTimeout(function() {
                                h(), d.reject([errors.connect, errors.timeout])
                            }, s.options.iframeTimeout)), p.submit()
                        });
                    return l && e(l).is(":file") && e(l).val() ? (p.append(l), i = l.files ? l.files.length : 1, p.append('<input type="hidden" name="' + (s.newAPI ? "target" : "current") + '" value="' + s.cwd().hash + '"/>').append('<input type="hidden" name="html" value="1"/>').append(e(l).attr("name", "upload[]")), e.each(s.options.onlyMimes || [], function(e, t) {
                        p.append('<input type="hidden" name="mimes[]" value="' + t + '"/>')
                    }), e.each(s.options.customData, function(e, t) {
                        p.append('<input type="hidden" name="' + e + '" value="' + t + '"/>')
                    }), p.appendTo("body"), f.appendTo("body"), d) : d.reject()
                },
                xhr: function(t, n) {
                    var i, r = n ? n : this,
                        a = e.Deferred().fail(function(e) {
                            e && r.error(e)
                        }).done(function(e) {
                            e.warning && r.error(e.warning), e.removed && r.remove(e), e.added && r.add(e), e.changed && r.change(e), r.trigger("upload", e), e.sync && r.sync()
                        }).always(function() {
                            i && clearTimeout(i), p && r.notify({
                                type: "upload",
                                cnt: -d,
                                progress: 100 * d
                            })
                        }),
                        o = new XMLHttpRequest,
                        s = new FormData,
                        l = t.input ? t.input.files : t.files,
                        d = l.length,
                        c = 5,
                        p = !1,
                        u = function() {
                            return setTimeout(function() {
                                p = !0, r.notify({
                                    type: "upload",
                                    cnt: d,
                                    progress: c * d
                                })
                            }, r.options.notifyDelay)
                        };
                    return d ? (o.addEventListener("error", function() {
                        a.reject("errConnect")
                    }, !1), o.addEventListener("abort", function() {
                        a.reject(["errConnect", "errAbort"])
                    }, !1), o.addEventListener("load", function() {
                        var e, t = o.status;
                        return t > 500 ? a.reject("errResponse") : t >= 400 ? a.reject("errConnect") : 4 != o.readyState ? a.reject(["errConnect", "errTimeout"]) : o.responseText ? (e = r.parseUploadData(o.responseText), e.error ? a.reject(e.error) : a.resolve(e), void 0) : a.reject(["errResponse", "errDataEmpty"])
                    }, !1), o.upload.addEventListener("progress", function(e) {
                        var t, n = c;
                        e.lengthComputable && (t = parseInt(100 * e.loaded / e.total), t > 0 && !i && (i = u()), t - n > 4 && (c = t, p && r.notify({
                            type: "upload",
                            cnt: 0,
                            progress: (c - n) * d
                        })))
                    }, !1), o.open("POST", r.uploadURL, !0), s.append("cmd", "upload"), s.append(r.newAPI ? "target" : "current", r.cwd().hash), e.each(r.options.customData, function(e, t) {
                        s.append(e, t)
                    }), e.each(r.options.onlyMimes, function(e, t) {
                        s.append("mimes[" + e + "]", t)
                    }), e.each(l, function(e, t) {
                        s.append("upload[]", t)
                    }), o.onreadystatechange = function() {
                        4 == o.readyState && 0 == o.status && a.reject(["errConnect", "errAbort"])
                    }, o.send(s), this.UA.Safari && t.files || (i = u()), a) : a.reject()
                }
            },
            one: function(t, n) {
                var i = this,
                    r = e.proxy(n, function(e) {
                        return setTimeout(function() {
                            i.unbind(e.type, r)
                        }, 3), n.apply(this, arguments)
                    });
                return this.bind(t, r)
            },
            localStorage: function(e, t) {
                var n = window.localStorage;
                if (e = "elfinder-" + e + this.id, null === t) return console.log("remove", e), n.removeItem(e);
                if (void 0 !== t) try {
                    n.setItem(e, t)
                } catch (i) {
                    n.clear(), n.setItem(e, t)
                }
                return n.getItem(e)
            },
            cookie: function(t, n) {
                var i, r, a, o;
                if (t = "elfinder-" + t + this.id, void 0 === n) {
                    if (document.cookie && "" != document.cookie)
                        for (a = document.cookie.split(";"), t += "=", o = 0; o < a.length; o++)
                            if (a[o] = e.trim(a[o]), a[o].substring(0, t.length) == t) return decodeURIComponent(a[o].substring(t.length));
                    return ""
                }
                return r = e.extend({}, this.options.cookie), null === n && (n = "", r.expires = -1), "number" == typeof r.expires && (i = new Date, i.setTime(i.getTime() + 864e5 * r.expires), r.expires = i), document.cookie = t + "=" + encodeURIComponent(n) + "; expires=" + r.expires.toUTCString() + (r.path ? "; path=" + r.path : "") + (r.domain ? "; domain=" + r.domain : "") + (r.secure ? "; secure" : ""), n
            },
            startDir: function() {
                var e = window.location.hash;
                return e && e.match(/^#elf_/) ? e.replace(/^#elf_/, "") : this.lastDir()
            },
            lastDir: function(e) {
                return this.options.rememberLastDir ? this.storage("lastdir", e) : ""
            },
            _node: e("<span/>"),
            escape: function(e) {
                return this._node.text(e).html().replace(/"/g, "&quot;").replace(/'/g, "&#039;")
            },
            normalize: function(t) {
                var n = function(e) {
                    return e && e.hash && e.name && e.mime ? ("application/x-empty" == e.mime && (e.mime = "text/plain"), e) : null
                };
                return t.files && (t.files = e.map(t.files, n)), t.tree && (t.tree = e.map(t.tree, n)), t.added && (t.added = e.map(t.added, n)), t.changed && (t.changed = e.map(t.changed, n)), t.api && (t.init = !0), t
            },
            setSort: function(e, t, n) {
                this.storage("sortType", this.sortType = this.sortRules[e] ? e : "name"), this.storage("sortOrder", this.sortOrder = /asc|desc/.test(t) ? t : "asc"), this.storage("sortStickFolders", (this.sortStickFolders = !!n) ? 1 : ""), this.trigger("sortchange")
            },
            _sortRules: {
                name: function(e, t) {
                    var n = elFinder.prototype._sortRules.name;
                    "undefined" == typeof n.loc && (n.loc = navigator.userLanguage || navigator.browserLanguage || navigator.language || "en-US"), "undefined" == typeof n.sort && ("11".localeCompare("2", n.loc, {
                        numeric: !0
                    }) > 0 ? n.sort = function(e, t) {
                        return e.localeCompare(t, n.loc, {
                            numeric: !0
                        })
                    } : (n.sort = function(e, t) {
                        var i, r, a = /(^-?[0-9]+(\.?[0-9]*)[df]?e?[0-9]?$|^0x[0-9a-f]+$|[0-9]+)/gi,
                            o = /(^[ ]*|[ ]*$)/g,
                            s = /(^([\w ]+,?[\w ]+)?[\w ]+,?[\w ]+\d+:\d+(:\d+)?[\w ]?|^\d{1,4}[\/\-]\d{1,4}[\/\-]\d{1,4}|^\w+, \w+ \d+, \d{4})/,
                            l = /^0x[0-9a-f]+$/i,
                            d = /^0/,
                            c = /^[\x01\x21-\x2f\x3a-\x40\x5b-\x60\x7b-\x7e]/,
                            p = function(e) {
                                return n.sort.insensitive && ("" + e).toLowerCase() || "" + e
                            },
                            u = p(e).replace(o, "").replace(/^_/, "") || "",
                            h = p(t).replace(o, "").replace(/^_/, "") || "",
                            f = u.replace(a, "\0$1\0").replace(/\0$/, "").replace(/^\0/, "").split("\0"),
                            m = h.replace(a, "\0$1\0").replace(/\0$/, "").replace(/^\0/, "").split("\0"),
                            g = parseInt(u.match(l)) || 1 != f.length && u.match(s) && Date.parse(u),
                            v = parseInt(h.match(l)) || g && h.match(s) && Date.parse(h) || null,
                            b = 0;
                        if (v) {
                            if (v > g) return -1;
                            if (g > v) return 1
                        }
                        for (var y = 0, w = Math.max(f.length, m.length); w > y; y++) {
                            if (i = !(f[y] || "").match(d) && parseFloat(f[y]) || f[y] || 0, r = !(m[y] || "").match(d) && parseFloat(m[y]) || m[y] || 0, isNaN(i) !== isNaN(r)) {
                                if (isNaN(i) && ("string" != typeof i || !i.match(c))) return 1;
                                if ("string" != typeof r || !r.match(c)) return -1
                            }
                            if (0 === parseInt(i, 10) && (i = 0), 0 === parseInt(r, 10) && (r = 0), typeof i != typeof r && (i += "", r += ""), n.sort.insensitive && "string" == typeof i && "string" == typeof r && (b = i.localeCompare(r, n.loc), 0 !== b)) return b;
                            if (r > i) return -1;
                            if (i > r) return 1
                        }
                        return 0
                    }, n.sort.insensitive = !0));
                    var i, r, a = e.name.toLowerCase(),
                        o = t.name.toLowerCase(),
                        s = "",
                        l = "";
                    return (i = a.match(/^(.+)(\.[0-9a-z.]+)$/)) && (a = i[1], s = i[2]), (i = o.match(/^(.+)(\.[0-9a-z.]+)$/)) && (o = i[1], l = i[2]), r = n.sort(a, o), 0 == r && (s || l) && s != l && (r = n.sort(s, l)), r
                },
                size: function(e, t) {
                    var n = parseInt(e.size) || 0,
                        i = parseInt(t.size) || 0;
                    return n == i ? 0 : n > i ? 1 : -1
                },
                kind: function(e, t) {
                    return e.mime.localeCompare(t.mime)
                },
                date: function(e, t) {
                    var n = e.ts || e.date,
                        i = t.ts || t.date;
                    return n == i ? 0 : n > i ? 1 : -1
                }
            },
            compare: function(e, t) {
                var n, i = this,
                    r = i.sortType,
                    a = "asc" == i.sortOrder,
                    o = i.sortStickFolders,
                    s = i.sortRules,
                    l = s[r],
                    d = "directory" == e.mime,
                    c = "directory" == t.mime;
                if (o) {
                    if (d && !c) return -1;
                    if (!d && c) return 1
                }
                return n = a ? l(e, t) : l(t, e), "name" != r && 0 == n ? n = a ? s.name(e, t) : s.name(t, e) : n
            },
            sortFiles: function(e) {
                return e.sort(this.compare)
            },
            notify: function(t) {
                var n, i, r, a = t.type,
                    o = this.messages["ntf" + a] ? this.i18n("ntf" + a) : this.i18n("ntfsmth"),
                    s = this.ui.notify,
                    l = s.children(".elfinder-notify-" + a),
                    d = '<div class="elfinder-notify elfinder-notify-{type}"><span class="elfinder-dialog-icon elfinder-dialog-icon-{type}"/><span class="elfinder-notify-msg">{msg}</span> <span class="elfinder-notify-cnt"/><div class="elfinder-notify-progressbar"><div class="elfinder-notify-progress"/></div></div>',
                    c = t.cnt,
                    p = t.progress >= 0 && t.progress <= 100 ? t.progress : 0;
                return a ? (l.length || (l = e(d.replace(/\{type\}/g, a).replace(/\{msg\}/g, o)).appendTo(s).data("cnt", 0), p && l.data({
                    progress: 0,
                    total: 0
                })), n = c + parseInt(l.data("cnt")), n > 0 ? (!t.hideCnt && l.children(".elfinder-notify-cnt").text("(" + n + ")"), s.is(":hidden") && s.elfinderdialog("open"), l.data("cnt", n), 100 > p && (i = l.data("total")) >= 0 && (r = l.data("progress")) >= 0 && (i = c + parseInt(l.data("total")), r = p + r, p = parseInt(r / i), l.data({
                    progress: r,
                    total: i
                }), s.find(".elfinder-notify-progress").animate({
                    width: (100 > p ? p : 100) + "%"
                }, 20))) : (l.remove(), !s.children().length && s.elfinderdialog("close")), this) : this
            },
            confirm: function(t) {
                var n, i = !1,
                    r = {
                        cssClass: "elfinder-dialog-confirm",
                        modal: !0,
                        resizable: !1,
                        title: this.i18n(t.title || "confirmReq"),
                        buttons: {},
                        close: function() {
                            !i && t.cancel.callback(), e(this).elfinderdialog("destroy")
                        }
                    },
                    a = this.i18n("apllyAll");
                return t.reject && (r.buttons[this.i18n(t.reject.label)] = function() {
                    t.reject.callback(!(!n || !n.prop("checked"))), i = !0, e(this).elfinderdialog("close")
                }), r.buttons[this.i18n(t.accept.label)] = function() {
                    t.accept.callback(!(!n || !n.prop("checked"))), i = !0, e(this).elfinderdialog("close")
                }, r.buttons[this.i18n(t.cancel.label)] = function() {
                    e(this).elfinderdialog("close")
                }, t.all && (t.reject && (r.width = 370), r.create = function() {
                    n = e('<input type="checkbox" />'), e(this).next().children().before(e("<label>" + a + "</label>").prepend(n))
                }, r.open = function() {
                    var t = e(this).next(),
                        n = parseInt(t.children(":first").outerWidth() + t.children(":last").outerWidth());
                    n > parseInt(t.width()) && e(this).closest(".elfinder-dialog").width(n + 30)
                }), this.dialog('<span class="elfinder-dialog-icon elfinder-dialog-icon-confirm"/>' + this.i18n(t.text), r)
            },
            uniqueName: function(e, t) {
                var n, i, r = 0,
                    a = "";
                if (e = this.i18n(e), t = t || this.cwd().hash, -1 != (n = e.indexOf(".txt")) && (a = ".txt", e = e.substr(0, n)), i = e + a, !this.fileByName(i, t)) return i;
                for (; 1e4 > r;)
                    if (i = e + " " + ++r + a, !this.fileByName(i, t)) return i;
                return e + Math.random() + a
            },
            i18n: function() {
                var t, n, i, r = this,
                    a = this.messages,
                    o = [],
                    s = [],
                    l = function(e) {
                        var t;
                        return 0 === e.indexOf("#") && (t = r.file(e.substr(1))) ? t.name : e
                    };
                for (t = 0; t < arguments.length; t++)
                    if (i = arguments[t], "string" == typeof i) o.push(l(i));
                    else if (e.isArray(i))
                    for (n = 0; n < i.length; n++) "string" == typeof i[n] && o.push(l(i[n]));
                for (t = 0; t < o.length; t++) - 1 === e.inArray(t, s) && (i = o[t], i = a[i] || r.escape(i), i = i.replace(/\$(\d+)/g, function(e, n) {
                    return n = t + parseInt(n), n > 0 && o[n] && s.push(n), r.escape(o[n]) || ""
                }), o[t] = i);
                return e.map(o, function(t, n) {
                    return -1 === e.inArray(n, s) ? t : null
                }).join("<br>")
            },
            mime2class: function(e) {
                var t = "elfinder-cwd-icon-";
                return e = e.split("/"), t + e[0] + ("image" != e[0] && e[1] ? " " + t + e[1].replace(/(\.|\+)/g, "-") : "")
            },
            mime2kind: function(e) {
                var t, n = "object" == typeof e ? e.mime : e;
                return t = e.alias ? "Alias" : this.kinds[n] ? this.kinds[n] : 0 === n.indexOf("text") ? "Text" : 0 === n.indexOf("image") ? "Image" : 0 === n.indexOf("audio") ? "Audio" : 0 === n.indexOf("video") ? "Video" : 0 === n.indexOf("application") ? "App" : n, this.messages["kind" + t] ? this.i18n("kind" + t) : n
            },
            formatDate: function(e, t) {
                var n, i, r, a, o, s, l, d, c, p, u, h = this,
                    t = t || e.ts,
                    f = h.i18;
                return h.options.clientFormatDate && t > 0 ? (n = new Date(1e3 * t), d = n[h.getHours](), c = d > 12 ? d - 12 : d, p = n[h.getMinutes](), u = n[h.getSeconds](), a = n[h.getDate](), o = n[h.getDay](), s = n[h.getMonth]() + 1, l = n[h.getFullYear](), i = t >= this.yesterday ? this.fancyFormat : this.dateFormat, r = i.replace(/[a-z]/gi, function(e) {
                    switch (e) {
                        case "d":
                            return a > 9 ? a : "0" + a;
                        case "j":
                            return a;
                        case "D":
                            return h.i18n(f.daysShort[o]);
                        case "l":
                            return h.i18n(f.days[o]);
                        case "m":
                            return s > 9 ? s : "0" + s;
                        case "n":
                            return s;
                        case "M":
                            return h.i18n(f.monthsShort[s - 1]);
                        case "F":
                            return h.i18n(f.months[s - 1]);
                        case "Y":
                            return l;
                        case "y":
                            return ("" + l).substr(2);
                        case "H":
                            return d > 9 ? d : "0" + d;
                        case "G":
                            return d;
                        case "g":
                            return c;
                        case "h":
                            return c > 9 ? c : "0" + c;
                        case "a":
                            return d > 12 ? "pm" : "am";
                        case "A":
                            return d > 12 ? "PM" : "AM";
                        case "i":
                            return p > 9 ? p : "0" + p;
                        case "s":
                            return u > 9 ? u : "0" + u
                    }
                    return e
                }), t >= this.yesterday ? r.replace("$1", this.i18n(t >= this.today ? "Today" : "Yesterday")) : r) : e.date ? e.date.replace(/([a-z]+)\s/i, function(e, t) {
                    return h.i18n(t) + " "
                }) : h.i18n("dateUnknown")
            },
            perms2class: function(e) {
                var t = "";
                return e.read || e.write ? e.read ? e.write || (t = "elfinder-ro") : t = "elfinder-wo" : t = "elfinder-na", t
            },
            formatPermissions: function(e) {
                var t = [];
                return e.read && t.push(this.i18n("read")), e.write && t.push(this.i18n("write")), t.length ? t.join(" " + this.i18n("and") + " ") : this.i18n("noaccess")
            },
            formatSize: function(e) {
                var t = 1,
                    n = "b";
                return "unknown" == e ? this.i18n("unknown") : (e > 1073741824 ? (t = 1073741824, n = "GB") : e > 1048576 ? (t = 1048576, n = "MB") : e > 1024 && (t = 1024, n = "KB"), e /= t, (e > 0 ? t >= 1048576 ? e.toFixed(2) : Math.round(e) : 0) + " " + n)
            },
            navHash2Id: function(e) {
                return "nav-" + e
            },
            navId2Hash: function(e) {
                return "string" == typeof e ? e.substr(4) : !1
            },
            log: function(e) {
                return window.console && window.console.log && window.console.log(e), this
            },
            debug: function(t, n) {
                var i = this.options.debug;
                return ("all" == i || i === !0 || e.isArray(i) && -1 != e.inArray(t, i)) && window.console && window.console.log && window.console.log("elfinder debug: [" + t + "] [" + this.id + "]", n), this
            },
            time: function(e) {
                window.console && window.console.time && window.console.time(e)
            },
            timeEnd: function(e) {
                window.console && window.console.timeEnd && window.console.timeEnd(e)
            }
        }, elFinder.prototype.version = "2.0.6", e.fn.elfinder = function(e) {
            return "instance" == e ? this.getElFinder() : this.each(function() {
                var t = "string" == typeof e ? e : "";
                switch (this.elfinder || new elFinder(this, "object" == typeof e ? e : {}), t) {
                    case "close":
                    case "hide":
                        this.elfinder.hide();
                        break;
                    case "open":
                    case "show":
                        this.elfinder.show();
                        break;
                    case "destroy":
                        this.elfinder.destroy()
                }
            })
        }, e.fn.getElFinder = function() {
            var e;
            return this.each(function() {
                return this.elfinder ? (e = this.elfinder, !1) : void 0
            }), e
        }, elFinder.prototype._options = {
            url: "",
            requestType: "get",
            transport: {},
            urlUpload: "",
            dragUploadAllow: "auto",
            iframeTimeout: 0,
            customData: {},
            handlers: {},
            lang: "en",
            cssClass: "",
            commands: ["open", "reload", "home", "up", "back", "forward", "getfile", "quicklook", "download", "rm", "duplicate", "rename", "mkdir", "mkfile", "upload", "copy", "cut", "paste", "edit", "extract", "archive", "search", "info", "view", "help", "resize", "sort", "netmount"],
            commandsOptions: {
                getfile: {
                    onlyURL: !1,
                    multiple: !1,
                    folders: !1,
                    oncomplete: ""
                },
                upload: {
                    ui: "uploadbutton"
                },
                quicklook: {
                    autoplay: !0,
                    jplayer: "extensions/jplayer"
                },
                edit: {
                    mimes: [],
                    editors: []
                },
                info: {
                    nullUrlDirLinkSelf: !0
                },
                help: {
                    view: ["about", "shortcuts", "help"]
                }
            },
            getFileCallback: null,
            defaultView: "icons",
            ui: ["toolbar", "tree", "path", "stat"],
            uiOptions: {
                toolbar: [
                    ["back", "forward"],
                    ["netmount"],
                    ["mkdir", "mkfile", "upload"],
                    ["open", "download", "getfile"],
                    ["info"],
                    ["quicklook"],
                    ["copy", "cut", "paste"],
                    ["rm"],
                    ["duplicate", "rename", "edit", "resize"],
                    ["extract", "archive"],
                    ["search"],
                    ["view", "sort"],
                    ["help"]
                ],
                tree: {
                    openRootOnLoad: !0,
                    syncTree: !0
                },
                navbar: {
                    minWidth: 150,
                    maxWidth: 500
                },
                cwd: {
                    oldSchool: !1
                }
            },
            onlyMimes: [],
            sortRules: {},
            sortType: "name",
            sortOrder: "asc",
            sortStickFolders: !0,
            clientFormatDate: !0,
            UTCDate: !1,
            dateFormat: "",
            fancyDateFormat: "",
            width: "auto",
            height: 400,
            resizable: !0,
            notifyDelay: 500,
            allowShortcuts: !0,
            rememberLastDir: !0,
            useBrowserHistory: !0,
            showFiles: 30,
            showThreshold: 50,
            validName: !1,
            sync: 0,
            loadTmbs: 5,
            cookie: {
                expires: 30,
                domain: "",
                path: "/",
                secure: !1
            },
            contextmenu: {
                navbar: ["open", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "info"],
                cwd: ["reload", "back", "|", "upload", "mkdir", "mkfile", "paste", "|", "sort", "|", "info"],
                files: ["getfile", "|", "open", "quicklook", "|", "download", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "edit", "rename", "resize", "|", "archive", "extract", "|", "info"]
            },
            debug: ["error", "warning", "event-destroy"]
        }, elFinder.prototype.history = function(t) {
            var n, i = this,
                r = !0,
                a = [],
                o = function() {
                    a = [t.cwd().hash], n = 0, r = !0
                },
                s = t.options.useBrowserHistory && window.history && window.history.pushState ? window.history : null,
                l = function(s) {
                    return s && i.canForward() || !s && i.canBack() ? (r = !1, t.exec("open", a[s ? ++n : --n]).fail(o)) : e.Deferred().reject()
                };
            this.canBack = function() {
                return n > 0
            }, this.canForward = function() {
                return n < a.length - 1
            }, this.back = l, this.forward = function() {
                return l(!0)
            }, t.open(function() {
                var e = a.length,
                    i = t.cwd().hash;
                r && (n >= 0 && e > n + 1 && a.splice(n + 1), a[a.length - 1] != i && a.push(i), n = a.length - 1), r = !0, s && (s.state ? s.state.thash != i && s.pushState({
                    thash: i
                }, null, location.pathname + location.search + "#elf_" + i) : s.replaceState({
                    thash: i
                }, null, location.pathname + location.search + "#elf_" + i))
            }).reload(o)
        }, elFinder.prototype.command = function(t) {
            this.fm = t, this.name = "", this.title = "", this.state = -1, this.alwaysEnabled = !1, this._disabled = !1, this.disableOnSearch = !1, this.updateOnSelect = !0, this._handlers = {
                enable: function() {
                    this.update(void 0, this.value)
                },
                disable: function() {
                    this.update(-1, this.value)
                },
                "open reload load": function() {
                    this._disabled = !(this.alwaysEnabled || this.fm.isCommandEnabled(this.name)), this.update(void 0, this.value), this.change()
                }
            }, this.handlers = {}, this.shortcuts = [], this.options = {
                ui: "button"
            }, this.setup = function(t, n) {
                var i, r, a = this,
                    o = this.fm;
                for (this.name = t, this.title = o.messages["cmd" + t] ? o.i18n("cmd" + t) : t, this.options = e.extend({}, this.options, n), this.listeners = [], this.updateOnSelect && (this._handlers.select = function() {
                        this.update(void 0, this.value)
                    }), e.each(e.extend({}, a._handlers, a.handlers), function(t, n) {
                        o.bind(t, e.proxy(n, a))
                    }), i = 0; i < this.shortcuts.length; i++) r = this.shortcuts[i], r.callback = e.proxy(r.callback || function() {
                    this.exec()
                }, this), !r.description && (r.description = this.title), o.shortcut(r);
                this.disableOnSearch && o.bind("search searchend", function(e) {
                    a._disabled = "search" == e.type, a.update(void 0, a.value)
                }), this.init()
            }, this.init = function() {}, this.exec = function() {
                return e.Deferred().reject()
            }, this.disabled = function() {
                return this.state < 0
            }, this.enabled = function() {
                return this.state > -1
            }, this.active = function() {
                return this.state > 0
            }, this.getstate = function() {
                return -1
            }, this.update = function(e, t) {
                var n = this.state,
                    i = this.value;
                this.state = this._disabled ? -1 : void 0 !== e ? e : this.getstate(), this.value = t, (n != this.state || i != this.value) && this.change()
            }, this.change = function(e) {
                var t, n;
                if ("function" == typeof e) this.listeners.push(e);
                else
                    for (n = 0; n < this.listeners.length; n++) {
                        t = this.listeners[n];
                        try {
                            t(this.state, this.value)
                        } catch (i) {
                            this.fm.debug("error", i)
                        }
                    }
                return this
            }, this.hashes = function(n) {
                return n ? e.map(e.isArray(n) ? n : [n], function(e) {
                    return t.file(e) ? e : null
                }) : t.selected()
            }, this.files = function(t) {
                var n = this.fm;
                return t ? e.map(e.isArray(t) ? t : [t], function(e) {
                    return n.file(e) || null
                }) : n.selectedFiles()
            }
        }, elFinder.prototype.resources = {
            "class": {
                hover: "ui-state-hover",
                active: "ui-state-active",
                disabled: "ui-state-disabled",
                draggable: "ui-draggable",
                droppable: "ui-droppable",
                adroppable: "elfinder-droppable-active",
                cwdfile: "elfinder-cwd-file",
                cwd: "elfinder-cwd",
                tree: "elfinder-tree",
                treeroot: "elfinder-navbar-root",
                navdir: "elfinder-navbar-dir",
                navdirwrap: "elfinder-navbar-dir-wrapper",
                navarrow: "elfinder-navbar-arrow",
                navsubtree: "elfinder-navbar-subtree",
                navcollapse: "elfinder-navbar-collapsed",
                navexpand: "elfinder-navbar-expanded",
                treedir: "elfinder-tree-dir",
                placedir: "elfinder-place-dir",
                searchbtn: "elfinder-button-search"
            },
            tpl: {
                perms: '<span class="elfinder-perms"/>',
                symlink: '<span class="elfinder-symlink"/>',
                navicon: '<span class="elfinder-nav-icon"/>',
                navspinner: '<span class="elfinder-navbar-spinner"/>',
                navdir: '<div class="elfinder-navbar-wrapper"><span id="{id}" class="ui-corner-all elfinder-navbar-dir {cssclass}"><span class="elfinder-navbar-arrow"/><span class="elfinder-navbar-icon"/>{symlink}{permissions}{name}</span><div class="elfinder-navbar-subtree"/></div>'
            },
            mimes: {
                text: ["application/x-empty", "application/javascript", "application/xhtml+xml", "audio/x-mp3-playlist", "application/x-web-config", "application/docbook+xml", "application/x-php", "application/x-perl", "application/x-awk", "application/x-config", "application/x-csh", "application/xml"]
            },
            mixin: {
                make: function() {
                    var t = this.fm,
                        n = this.name,
                        i = t.getUI("cwd"),
                        r = e.Deferred().fail(function(e) {
                            i.trigger("unselectall"), e && t.error(e)
                        }).always(function() {
                            c.remove(), d.remove(), t.enable()
                        }),
                        a = "tmp_" + parseInt(1e5 * Math.random()),
                        o = t.cwd().hash,
                        s = new Date,
                        l = {
                            hash: a,
                            name: t.uniqueName(this.prefix),
                            mime: this.mime,
                            read: !0,
                            write: !0,
                            date: "Today " + s.getHours() + ":" + s.getMinutes()
                        },
                        d = i.trigger("create." + t.namespace, l).find("#" + a),
                        c = e('<input type="text"/>').keydown(function(t) {
                            t.stopImmediatePropagation(), t.keyCode == e.ui.keyCode.ESCAPE ? r.reject() : t.keyCode == e.ui.keyCode.ENTER && c.blur()
                        }).mousedown(function(e) {
                            e.stopPropagation()
                        }).blur(function() {
                            var i = e.trim(c.val()),
                                s = c.parent();
                            if (s.length) {
                                if (!i) return r.reject("errInvName");
                                if (t.fileByName(i, o)) return r.reject(["errExists", i]);
                                s.html(t.escape(i)), t.lockfiles({
                                    files: [a]
                                }), t.request({
                                    data: {
                                        cmd: n,
                                        name: i,
                                        target: o
                                    },
                                    notify: {
                                        type: n,
                                        cnt: 1
                                    },
                                    preventFail: !0,
                                    syncOnFail: !0
                                }).fail(function(e) {
                                    r.reject(e)
                                }).done(function(e) {
                                    r.resolve(e)
                                })
                            }
                        });
                    return this.disabled() || !d.length ? r.reject() : (t.disable(), d.find(".elfinder-cwd-filename").empty("").append(c.val(l.name)), c.select().focus(), c[0].setSelectionRange && c[0].setSelectionRange(0, l.name.replace(/\..+$/, "").length), r)
                }
            }
        }, e.fn.dialogelfinder = function(t) {
            var n = "elfinderPosition",
                i = "elfinderDestroyOnClose";
            if (this.not(".elfinder").each(function() {
                    var r = (e(document), e('<div class="ui-widget-header dialogelfinder-drag ui-corner-top">' + (t.title || "Files") + "</div>")),
                        a = (e('<a href="#" class="dialogelfinder-drag-close ui-corner-all"><span class="ui-icon ui-icon-closethick"/></a>').appendTo(r).click(function(e) {
                            e.preventDefault(), a.dialogelfinder("close")
                        }), e(this).addClass("dialogelfinder").css("position", "absolute").hide().appendTo("body").draggable({
                            handle: ".dialogelfinder-drag",
                            containment: "window"
                        }).elfinder(t).prepend(r));
                    a.elfinder("instance"), a.width(parseInt(a.width()) || 840).data(i, !!t.destroyOnClose).find(".elfinder-toolbar").removeClass("ui-corner-top"), t.position && a.data(n, t.position), t.autoOpen !== !1 && e(this).dialogelfinder("open")
                }), "open" == t) {
                var r = e(this),
                    a = r.data(n) || {
                        top: parseInt(e(document).scrollTop() + (e(window).height() < r.height() ? 2 : (e(window).height() - r.height()) / 2)),
                        left: parseInt(e(document).scrollLeft() + (e(window).width() < r.width() ? 2 : (e(window).width() - r.width()) / 2))
                    },
                    o = 100;
                r.is(":hidden") && (e("body").find(":visible").each(function() {
                    var t, n = e(this);
                    this !== r[0] && "absolute" == n.css("position") && (t = parseInt(n.zIndex())) > o && (o = t + 1)
                }), r.zIndex(o).css(a).show().trigger("resize"), setTimeout(function() {
                    r.trigger("resize").mousedown()
                }, 200))
            } else if ("close" == t) {
                var r = e(this);
                r.is(":visible") && (r.data(i) ? r.elfinder("destroy").remove() : r.elfinder("close"))
            } else if ("instance" == t) return e(this).getElFinder();
            return this
        }, elFinder && elFinder.prototype && "object" == typeof elFinder.prototype.i18 && (elFinder.prototype.i18.en = {
            translator: "Troex Nevelin &lt;troex@fury.scancode.ru&gt;",
            language: "English",
            direction: "ltr",
            dateFormat: "M d, Y h:i A",
            fancyDateFormat: "$1 h:i A",
            messages: {
                error: "Error",
                errUnknown: "Unknown error.",
                errUnknownCmd: "Unknown command.",
                errJqui: "Invalid jQuery UI configuration. Selectable, draggable and droppable components must be included.",
                errNode: "elFinder requires DOM Element to be created.",
                errURL: "Invalid elFinder configuration! URL option is not set.",
                errAccess: "Access denied.",
                errConnect: "Unable to connect to backend.",
                errAbort: "Connection aborted.",
                errTimeout: "Connection timeout.",
                errNotFound: "Backend not found.",
                errResponse: "Invalid backend response.",
                errConf: "Invalid backend configuration.",
                errJSON: "PHP JSON module not installed.",
                errNoVolumes: "Readable volumes not available.",
                errCmdParams: 'Invalid parameters for command "$1".',
                errDataNotJSON: "Data is not JSON.",
                errDataEmpty: "Data is empty.",
                errCmdReq: "Backend request requires command name.",
                errOpen: 'Unable to open "$1".',
                errNotFolder: "Object is not a folder.",
                errNotFile: "Object is not a file.",
                errRead: 'Unable to read "$1".',
                errWrite: 'Unable to write into "$1".',
                errPerm: "Permission denied.",
                errLocked: '"$1" is locked and can not be renamed, moved or removed.',
                errExists: 'File named "$1" already exists.',
                errInvName: "Invalid file name.",
                errFolderNotFound: "Folder not found.",
                errFileNotFound: "File not found.",
                errTrgFolderNotFound: 'Target folder "$1" not found.',
                errPopup: "Browser prevented opening popup window. To open file enable it in browser options.",
                errMkdir: 'Unable to create folder "$1".',
                errMkfile: 'Unable to create file "$1".',
                errRename: 'Unable to rename "$1".',
                errCopyFrom: 'Copying files from volume "$1" not allowed.',
                errCopyTo: 'Copying files to volume "$1" not allowed.',
                errUpload: "Upload error.",
                errUploadFile: 'Unable to upload "$1".',
                errUploadNoFiles: "No files found for upload.",
                errUploadTotalSize: "Data exceeds the maximum allowed size.",
                errUploadFileSize: "File exceeds maximum allowed size.",
                errUploadMime: "File type not allowed.",
                errUploadTransfer: '"$1" transfer error.',
                errNotReplace: 'Object "$1" already exists at this location and can not be replaced by object with another type.',
                errReplace: 'Unable to replace "$1".',
                errSave: 'Unable to save "$1".',
                errCopy: 'Unable to copy "$1".',
                errMove: 'Unable to move "$1".',
                errCopyInItself: 'Unable to copy "$1" into itself.',
                errRm: 'Unable to remove "$1".',
                errRmSrc: "Unable remove source file(s).",
                errExtract: 'Unable to extract files from "$1".',
                errArchive: "Unable to create archive.",
                errArcType: "Unsupported archive type.",
                errNoArchive: "File is not archive or has unsupported archive type.",
                errCmdNoSupport: "Backend does not support this command.",
                errReplByChild: 'The folder "$1" can\'t be replaced by an item it contains.',
                errArcSymlinks: "For security reason denied to unpack archives contains symlinks or files with not allowed names.",
                errArcMaxSize: "Archive files exceeds maximum allowed size.",
                errResize: 'Unable to resize "$1".',
                errResizeDegree: "Invalid rotate degree.",
                errResizeRotate: "Unable to rotate image.",
                errResizeSize: "Invalid image size.",
                errResizeNoChange: "Image size not changed.",
                errUsupportType: "Unsupported file type.",
                errNotUTF8Content: 'File "$1" is not in UTF-8 and cannot be edited.',
                errNetMount: 'Unable to mount "$1".',
                errNetMountNoDriver: "Unsupported protocol.",
                errNetMountFailed: "Mount failed.",
                errNetMountHostReq: "Host required.",
                errSessionExpires: "Your session has expired due to inactivity.",
                errCreatingTempDir: 'Unable to create temporary directory: "$1"',
                errFtpDownloadFile: 'Unable to download file from FTP: "$1"',
                errFtpUploadFile: 'Unable to upload file to FTP: "$1"',
                errFtpMkdir: 'Unable to create remote directory on FTP: "$1"',
                errArchiveExec: 'Error while archiving files: "$1"',
                errExtractExec: 'Error while extracting files: "$1"',
                cmdarchive: "Create archive",
                cmdback: "Back",
                cmdcopy: "Copy",
                cmdcut: "Cut",
                cmddownload: "Download",
                cmdduplicate: "Duplicate",
                cmdedit: "Edit file",
                cmdextract: "Extract files from archive",
                cmdforward: "Forward",
                cmdgetfile: "Select files",
                cmdhelp: "About this software",
                cmdhome: "Home",
                cmdinfo: "Get info",
                cmdmkdir: "New folder",
                cmdmkfile: "New text file",
                cmdopen: "Open",
                cmdpaste: "Paste",
                cmdquicklook: "Preview",
                cmdreload: "Reload",
                cmdrename: "Rename",
                cmdrm: "Delete",
                cmdsearch: "Find files",
                cmdup: "Go to parent directory",
                cmdupload: "Upload files",
                cmdview: "View",
                cmdresize: "Resize & Rotate",
                cmdsort: "Sort",
                cmdnetmount: "Mount network volume",
                btnClose: "Close",
                btnSave: "Save",
                btnRm: "Remove",
                btnApply: "Apply",
                btnCancel: "Cancel",
                btnNo: "No",
                btnYes: "Yes",
                btnMount: "Mount",
                ntfopen: "Open folder",
                ntffile: "Open file",
                ntfreload: "Reload folder content",
                ntfmkdir: "Creating directory",
                ntfmkfile: "Creating files",
                ntfrm: "Delete files",
                ntfcopy: "Copy files",
                ntfmove: "Move files",
                ntfprepare: "Prepare to copy files",
                ntfrename: "Rename files",
                ntfupload: "Uploading files",
                ntfdownload: "Downloading files",
                ntfsave: "Save files",
                ntfarchive: "Creating archive",
                ntfextract: "Extracting files from archive",
                ntfsearch: "Searching files",
                ntfresize: "Resizing images",
                ntfsmth: "Doing something",
                ntfloadimg: "Loading image",
                ntfnetmount: "Mounting network volume",
                ntfdim: "Acquiring image dimension",
                dateUnknown: "unknown",
                Today: "Today",
                Yesterday: "Yesterday",
                msJan: "Jan",
                msFeb: "Feb",
                msMar: "Mar",
                msApr: "Apr",
                msMay: "May",
                msJun: "Jun",
                msJul: "Jul",
                msAug: "Aug",
                msSep: "Sep",
                msOct: "Oct",
                msNov: "Nov",
                msDec: "Dec",
                January: "January",
                February: "February",
                March: "March",
                April: "April",
                May: "May",
                June: "June",
                July: "July",
                August: "August",
                September: "September",
                October: "October",
                November: "November",
                December: "December",
                Sunday: "Sunday",
                Monday: "Monday",
                Tuesday: "Tuesday",
                Wednesday: "Wednesday",
                Thursday: "Thursday",
                Friday: "Friday",
                Saturday: "Saturday",
                Sun: "Sun",
                Mon: "Mon",
                Tue: "Tue",
                Wed: "Wed",
                Thu: "Thu",
                Fri: "Fri",
                Sat: "Sat",
                sortname: "by name",
                sortkind: "by kind",
                sortsize: "by size",
                sortdate: "by date",
                sortFoldersFirst: "Folders first",
                "untitled file.txt": "NewFile.txt",
                "untitled folder": "NewFolder",
                confirmReq: "Confirmation required",
                confirmRm: "Are you sure you want to remove files?<br/>This cannot be undone!",
                confirmRepl: "Replace old file with new one?",
                apllyAll: "Apply to all",
                name: "Name",
                size: "Size",
                perms: "Permissions",
                modify: "Modified",
                kind: "Kind",
                read: "read",
                write: "write",
                noaccess: "no access",
                and: "and",
                unknown: "unknown",
                selectall: "Select all files",
                selectfiles: "Select file(s)",
                selectffile: "Select first file",
                selectlfile: "Select last file",
                viewlist: "List view",
                viewicons: "Icons view",
                places: "Places",
                calc: "Calculate",
                path: "Path",
                aliasfor: "Alias for",
                locked: "Locked",
                dim: "Dimensions",
                files: "Files",
                folders: "Folders",
                items: "Items",
                yes: "yes",
                no: "no",
                link: "Link",
                searcresult: "Search results",
                selected: "selected items",
                about: "About",
                shortcuts: "Shortcuts",
                help: "Help",
                webfm: "Web file manager",
                ver: "Version",
                protocolver: "protocol version",
                homepage: "Project home",
                docs: "Documentation",
                github: "Fork us on Github",
                twitter: "Follow us on twitter",
                facebook: "Join us on facebook",
                team: "Team",
                chiefdev: "chief developer",
                developer: "developer",
                contributor: "contributor",
                maintainer: "maintainer",
                translator: "translator",
                icons: "Icons",
                dontforget: "and don't forget to take your towel",
                shortcutsof: "Shortcuts disabled",
                dropFiles: "Drop files here",
                or: "or",
                selectForUpload: "Select files to upload",
                moveFiles: "Move files",
                copyFiles: "Copy files",
                rmFromPlaces: "Remove from places",
                aspectRatio: "Aspect ratio",
                scale: "Scale",
                width: "Width",
                height: "Height",
                resize: "Resize",
                crop: "Crop",
                rotate: "Rotate",
                "rotate-cw": "Rotate 90 degrees CW",
                "rotate-ccw": "Rotate 90 degrees CCW",
                degree: "°",
                netMountDialogTitle: "Mount network volume",
                protocol: "Protocol",
                host: "Host",
                port: "Port",
                user: "User",
                pass: "Password",
                kindUnknown: "Unknown",
                kindFolder: "Folder",
                kindAlias: "Alias",
                kindAliasBroken: "Broken alias",
                kindApp: "Application",
                kindPostscript: "Postscript document",
                kindMsOffice: "Microsoft Office document",
                kindMsWord: "Microsoft Word document",
                kindMsExcel: "Microsoft Excel document",
                kindMsPP: "Microsoft Powerpoint presentation",
                kindOO: "Open Office document",
                kindAppFlash: "Flash application",
                kindPDF: "Portable Document Format (PDF)",
                kindTorrent: "Bittorrent file",
                kind7z: "7z archive",
                kindTAR: "TAR archive",
                kindGZIP: "GZIP archive",
                kindBZIP: "BZIP archive",
                kindXZ: "XZ archive",
                kindZIP: "ZIP archive",
                kindRAR: "RAR archive",
                kindJAR: "Java JAR file",
                kindTTF: "True Type font",
                kindOTF: "Open Type font",
                kindRPM: "RPM package",
                kindText: "Text document",
                kindTextPlain: "Plain text",
                kindPHP: "PHP source",
                kindCSS: "Cascading style sheet",
                kindHTML: "HTML document",
                kindJS: "Javascript source",
                kindRTF: "Rich Text Format",
                kindC: "C source",
                kindCHeader: "C header source",
                kindCPP: "C++ source",
                kindCPPHeader: "C++ header source",
                kindShell: "Unix shell script",
                kindPython: "Python source",
                kindJava: "Java source",
                kindRuby: "Ruby source",
                kindPerl: "Perl script",
                kindSQL: "SQL source",
                kindXML: "XML document",
                kindAWK: "AWK source",
                kindCSV: "Comma separated values",
                kindDOCBOOK: "Docbook XML document",
                kindImage: "Image",
                kindBMP: "BMP image",
                kindJPEG: "JPEG image",
                kindGIF: "GIF Image",
                kindPNG: "PNG Image",
                kindTIFF: "TIFF image",
                kindTGA: "TGA image",
                kindPSD: "Adobe Photoshop image",
                kindXBITMAP: "X bitmap image",
                kindPXM: "Pixelmator image",
                kindAudio: "Audio media",
                kindAudioMPEG: "MPEG audio",
                kindAudioMPEG4: "MPEG-4 audio",
                kindAudioMIDI: "MIDI audio",
                kindAudioOGG: "Ogg Vorbis audio",
                kindAudioWAV: "WAV audio",
                AudioPlaylist: "MP3 playlist",
                kindVideo: "Video media",
                kindVideoDV: "DV movie",
                kindVideoMPEG: "MPEG movie",
                kindVideoMPEG4: "MPEG-4 movie",
                kindVideoAVI: "AVI movie",
                kindVideoMOV: "Quick Time movie",
                kindVideoWM: "Windows Media movie",
                kindVideoFlash: "Flash movie",
                kindVideoMKV: "Matroska movie",
                kindVideoOGG: "Ogg movie"
            }
        }), e.fn.elfinderbutton = function(t) {
            return this.each(function() {
                var n, i = "class",
                    r = t.fm,
                    a = r.res(i, "disabled"),
                    o = r.res(i, "active"),
                    s = r.res(i, "hover"),
                    l = "elfinder-button-menu-item",
                    d = "elfinder-button-menu-item-selected",
                    c = e(this).addClass("ui-state-default elfinder-button").attr("title", t.title).append('<span class="elfinder-button-icon elfinder-button-icon-' + t.name + '"/>').hover(function(e) {
                        !c.is("." + a) && c["mouseleave" == e.type ? "removeClass" : "addClass"](s)
                    }).click(function(e) {
                        c.is("." + a) || (n && t.variants.length > 1 ? (n.is(":hidden") && t.fm.getUI().click(), e.stopPropagation(), n.slideToggle(100)) : t.exec())
                    }),
                    p = function() {
                        n.hide()
                    };
                e.isArray(t.variants) && (c.addClass("elfinder-menubutton"), n = e('<div class="ui-widget ui-widget-content elfinder-button-menu ui-corner-all"/>').hide().appendTo(c).zIndex(12 + c.zIndex()).delegate("." + l, "hover", function() {
                    e(this).toggleClass(s)
                }).delegate("." + l, "click", function(n) {
                    n.preventDefault(), n.stopPropagation(), c.removeClass(s), t.exec(t.fm.selected(), e(this).data("value"))
                }), t.fm.bind("disable select", p).getUI().click(p), t.change(function() {
                    n.html(""), e.each(t.variants, function(i, r) {
                        n.append(e('<div class="' + l + '">' + r[1] + "</div>").data("value", r[0]).addClass(r[0] == t.value ? d : ""))
                    })
                })), t.change(function() {
                    t.disabled() ? c.removeClass(o + " " + s).addClass(a) : (c.removeClass(a), c[t.active() ? "addClass" : "removeClass"](o))
                }).change()
            })
        }, e.fn.elfindercontextmenu = function(t) {
            return this.each(function() {
                var n = e(this).addClass("ui-helper-reset ui-widget ui-state-default ui-corner-all elfinder-contextmenu elfinder-contextmenu-" + t.direction).hide().appendTo("body").delegate(".elfinder-contextmenu-item", "mouseenter mouseleave", function() {
                        e(this).toggleClass("ui-state-hover")
                    }),
                    i = "ltr" == t.direction ? "left" : "right",
                    r = e.extend({}, t.options.contextmenu),
                    a = '<div class="elfinder-contextmenu-item"><span class="elfinder-button-icon {icon} elfinder-contextmenu-icon"/><span>{label}</span></div>',
                    o = function(t, n, i) {
                        return e(a.replace("{icon}", n ? "elfinder-button-icon-" + n : "").replace("{label}", t)).click(function(e) {
                            e.stopPropagation(), e.stopPropagation(), i()
                        })
                    },
                    s = function(r, a) {
                        var o = e(window),
                            s = n.outerWidth(),
                            l = n.outerHeight(),
                            d = o.width(),
                            c = o.height(),
                            p = o.scrollTop(),
                            u = o.scrollLeft(),
                            h = t.UA.Touch ? 10 : 0,
                            f = {
                                top: (c > a + h + l ? a + h : a - h - l > 0 ? a - h - l : a + h) + p,
                                left: (d > r + h + s ? r + h : r - h - s) + u,
                                "z-index": 100 + t.getUI("workzone").zIndex()
                            };
                        n.css(f).show(), f = {
                            "z-index": f["z-index"] + 10
                        }, f[i] = parseInt(n.width()), n.find(".elfinder-contextmenu-sub").css(f)
                    },
                    l = function() {
                        n.hide().empty()
                    },
                    d = function(i, a) {
                        var s = !1;
                        e.each(r[i] || [], function(i, r) {
                            var d, c, p, u;
                            if ("|" == r && s) return n.append('<div class="elfinder-contextmenu-separator"/>'), s = !1, void 0;
                            if (d = t.command(r), d && -1 != d.getstate(a)) {
                                if (d.variants) {
                                    if (!d.variants.length) return;
                                    c = o(d.title, d.name, function() {}), p = e('<div class="ui-corner-all elfinder-contextmenu-sub"/>').appendTo(c.append('<span class="elfinder-contextmenu-arrow"/>')), u = function() {
                                        var t, n, i, r = e(window),
                                            a = e(c).offset().left,
                                            o = e(c).offset().top,
                                            s = e(c).outerWidth(),
                                            l = p.outerWidth(),
                                            d = p.outerHeight(),
                                            u = r.scrollLeft() + r.width(),
                                            h = r.scrollTop() + r.height(),
                                            f = 5;
                                        i = a + s + l + f - u, t = i > 0 ? s - i : s, i = o + 5 + d + f - h, n = i > 0 ? 5 - i : 5;
                                        var m = {
                                            left: t,
                                            top: n
                                        };
                                        p.css(m).toggle()
                                    }, c.addClass("elfinder-contextmenu-group").hover(function() {
                                        u()
                                    }).on("touchstart", function(e) {
                                        return c.hasClass("ui-state-hover") ? !0 : (c.addClass("ui-state-hover"), e.preventDefault(), u(), !1)
                                    }), e.each(d.variants, function(t, n) {
                                        p.append(e('<div class="elfinder-contextmenu-item"><span>' + n[1] + "</span></div>").on("click touchstart", function(e) {
                                            e.stopPropagation(), l(), d.exec(a, n[0])
                                        }))
                                    })
                                } else c = o(d.title, d.name, function() {
                                    l(), d.exec(a)
                                });
                                n.append(c), s = !0
                            }
                        })
                    },
                    c = function(t) {
                        e.each(t, function(e, t) {
                            var i;
                            t.label && "function" == typeof t.callback && (i = o(t.label, t.icon, function() {
                                l(), t.callback()
                            }), n.append(i))
                        })
                    };
                t.one("load", function() {
                    t.bind("contextmenu", function(e) {
                        var t = e.data;
                        l(), t.type && t.targets ? d(t.type, t.targets) : t.raw && c(t.raw), n.children().length && s(t.x, t.y)
                    }).one("destroy", function() {
                        n.remove()
                    }).bind("disable select", l).getUI().click(l)
                })
            })
        }, e.fn.elfindercwd = function(t, n) {
            return this.not(".elfinder-cwd").each(function() {
                var i = "list" == t.viewType,
                    r = "select." + t.namespace,
                    a = "unselect." + t.namespace,
                    o = "disable." + t.namespace,
                    s = "enable." + t.namespace,
                    l = "class",
                    d = t.res(l, "cwdfile"),
                    c = "." + d,
                    p = "ui-selected",
                    u = t.res(l, "disabled"),
                    h = t.res(l, "draggable"),
                    f = t.res(l, "droppable"),
                    m = t.res(l, "hover"),
                    g = t.res(l, "adroppable"),
                    v = d + "-tmp",
                    b = t.options.loadTmbs > 0 ? t.options.loadTmbs : 5,
                    y = "",
                    w = [],
                    x = {
                        icon: '<div id="{hash}" class="' + d + ' {permsclass} {dirclass} ui-corner-all" title="{tooltip}"><div class="elfinder-cwd-file-wrapper ui-corner-all"><div class="elfinder-cwd-icon {mime} ui-corner-all" unselectable="on" {style}/>{marker}</div><div class="elfinder-cwd-filename" title="{name}">{name}</div></div>',
                        row: '<tr id="{hash}" class="' + d + ' {permsclass} {dirclass}" title="{tooltip}"><td><div class="elfinder-cwd-file-wrapper"><span class="elfinder-cwd-icon {mime}"/>{marker}<span class="elfinder-cwd-filename">{name}</span></div></td><td>{perms}</td><td>{date}</td><td>{size}</td><td>{kind}</td></tr>'
                    },
                    k = t.res("tpl", "perms"),
                    C = t.res("tpl", "symlink"),
                    T = {
                        permsclass: function(e) {
                            return t.perms2class(e)
                        },
                        perms: function(e) {
                            return t.formatPermissions(e)
                        },
                        dirclass: function(e) {
                            return "directory" == e.mime ? "directory" : ""
                        },
                        mime: function(e) {
                            return t.mime2class(e.mime)
                        },
                        size: function(e) {
                            return t.formatSize(e.size)
                        },
                        date: function(e) {
                            return t.formatDate(e)
                        },
                        kind: function(e) {
                            return t.mime2kind(e)
                        },
                        marker: function(e) {
                            return (e.alias || "symlink-broken" == e.mime ? C : "") + (e.read && e.write ? "" : k)
                        },
                        tooltip: function(e) {
                            var n = t.formatDate(e) + (e.size > 0 ? " (" + t.formatSize(e.size) + ")" : "");
                            return e.tooltip ? t.escape(e.tooltip).replace(/\r/g, "&#13;") + "&#13;" + n : n
                        }
                    },
                    I = function(e) {
                        return e.name = t.escape(e.name), x[i ? "row" : "icon"].replace(/\{([a-z]+)\}/g, function(t, n) {
                            return T[n] ? T[n](e) : e[n] ? e[n] : ""
                        })
                    },
                    F = !1,
                    P = function(t, n) {
                        function o(e, t) {
                            return e[t + "All"]("[id]:not(." + u + "):not(.elfinder-cwd-parent):first")
                        }
                        var s, l, d, c, h, f = e.ui.keyCode,
                            m = t == f.LEFT || t == f.UP,
                            g = B.find("[id]." + p);
                        if (g.length)
                            if (s = g.filter(m ? ":first" : ":last"), d = o(s, m ? "prev" : "next"), d.length)
                                if (i || t == f.LEFT || t == f.RIGHT) l = d;
                                else if (c = s.position().top, h = s.position().left, l = s, m) {
                            do l = l.prev("[id]"); while (l.length && !(l.position().top < c && l.position().left <= h));
                            l.is("." + u) && (l = o(l, "next"))
                        } else {
                            do l = l.next("[id]"); while (l.length && !(l.position().top > c && l.position().left >= h));
                            l.is("." + u) && (l = o(l, "prev")), l.length || (d = B.find("[id]:not(." + u + "):last"), d.position().top > c && (l = d))
                        } else l = s;
                        else l = B.find("[id]:not(." + u + "):not(.elfinder-cwd-parent):" + (m ? "last" : "first"));
                        l && l.length && !l.is(".elfinder-cwd-parent") && (n ? l = s.add(s[m ? "prevUntil" : "nextUntil"]("#" + l.attr("id"))).add(l) : g.trigger(a), l.trigger(r), S(l.filter(m ? ":first" : ":last")), M())
                    },
                    z = [],
                    A = function(e) {
                        B.find("#" + e).trigger(r)
                    },
                    O = function() {
                        var n = t.cwd().hash;
                        B.find("[id]:not(." + p + "):not(.elfinder-cwd-parent)").trigger(r), z = e.map(t.files(), function(e) {
                            return e.phash == n ? e.hash : null
                        }), M()
                    },
                    D = function() {
                        z = [], B.find("[id]." + p).trigger(a), M()
                    },
                    M = function() {
                        t.trigger("select", {
                            selected: z
                        })
                    },
                    S = function(e) {
                        var t = e.position().top,
                            n = e.outerHeight(!0),
                            i = K.scrollTop(),
                            r = K.innerHeight();
                        t + n > i + r ? K.scrollTop(parseInt(t + n - r)) : i > t && K.scrollTop(t)
                    },
                    E = [],
                    U = function(e) {
                        for (var t = E.length; t--;)
                            if (E[t].hash == e) return t;
                        return -1
                    },
                    j = "scroll." + t.namespace,
                    R = function() {
                        var n, a = [],
                            o = !1,
                            s = [],
                            l = {},
                            d = B.find("[id]:last"),
                            c = !d.length,
                            u = i ? B.children("table").children("tbody") : B;
                        if (!E.length) return K.unbind(j);
                        for (;
                            (!d.length || d.position().top <= K.height() + K.scrollTop() + t.options.showThreshold) && (n = E.splice(0, t.options.showFiles)).length;) a = e.map(n, function(e) {
                            return e.hash && e.name ? ("directory" == e.mime && (o = !0), e.tmb && (1 === e.tmb ? s.push(e.hash) : l[e.hash] = e.tmb), I(e)) : null
                        }), u.append(a.join("")), d = B.find("[id]:last"), c && B.scrollTop(0);
                        N(l), s.length && L(s), o && H(), z.length && u.find("[id]:not(." + p + "):not(.elfinder-cwd-parent)").each(function() {
                            var t = this.id; - 1 !== e.inArray(t, z) && e(this).trigger(r)
                        })
                    },
                    q = e.extend({}, t.droppable, {
                        over: function(n, i) {
                            var r = t.cwd().hash;
                            e.each(i.helper.data("files"), function(e, n) {
                                return t.file(n).phash == r ? (B.removeClass(g), !1) : void 0
                            })
                        }
                    }),
                    H = function() {
                        setTimeout(function() {
                            B.find(".directory:not(." + f + ",.elfinder-na,.elfinder-ro)").droppable(t.droppable)
                        }, 20)
                    },
                    N = function(n) {
                        var i, r = t.option("tmbUrl"),
                            a = !0;
                        return e.each(n, function(t, n) {
                            var o = B.find("#" + t);
                            o.length ? function(t, n) {
                                e("<img/>").load(function() {
                                    t.find(".elfinder-cwd-icon").css("background", "url('" + n + "') center center no-repeat")
                                }).attr("src", n)
                            }(o, r + n) : (a = !1, -1 != (i = U(t)) && (E[i].tmb = n))
                        }), a
                    },
                    L = function(e) {
                        var n = [];
                        return t.oldAPI ? (t.request({
                            data: {
                                cmd: "tmb",
                                current: t.cwd().hash
                            },
                            preventFail: !0
                        }).done(function(e) {
                            N(e.images || []) && e.tmb && L()
                        }), void 0) : (n = n = e.splice(0, b), n.length && t.request({
                            data: {
                                cmd: "tmb",
                                targets: n
                            },
                            preventFail: !0
                        }).done(function(t) {
                            N(t.images || []) && L(e)
                        }), void 0)
                    },
                    _ = function(e) {
                        for (var n, r, a, o, s = i ? B.find("tbody") : B, l = e.length, d = [], c = {}, p = !1, u = function(e) {
                                for (var n, i = B.find("[id]:first"); i.length;) {
                                    if (n = t.file(i.attr("id")), !i.is(".elfinder-cwd-parent") && n && t.compare(e, n) < 0) return i;
                                    i = i.next("[id]")
                                }
                            }, h = function(e) {
                                var n, i = E.length;
                                for (n = 0; i > n; n++)
                                    if (t.compare(e, E[n]) < 0) return n;
                                return i || -1
                            }; l--;) n = e[l], r = n.hash, B.find("#" + r).length || ((a = u(n)) && a.length ? a.before(I(n)) : (o = h(n)) >= 0 ? E.splice(o, 0, n) : s.append(I(n)), B.find("#" + r).length && ("directory" == n.mime ? p = !0 : n.tmb && (1 === n.tmb ? d.push(r) : c[r] = n.tmb)));
                        N(c), d.length && L(d), p && H()
                    },
                    W = function(e) {
                        for (var n, i, r, a = e.length; a--;)
                            if (n = e[a], (i = B.find("#" + n)).length) try {
                                i.detach()
                            } catch (o) {
                                t.debug("error", o)
                            } else -1 != (r = U(n)) && E.splice(r, 1)
                    },
                    V = {
                        name: t.i18n("name"),
                        perm: t.i18n("perms"),
                        mod: t.i18n("modify"),
                        size: t.i18n("size"),
                        kind: t.i18n("kind")
                    },
                    $ = function(r, a) {
                        var o = t.cwd().hash;
                        D();
                        try {
                            B.children("table," + c).remove()
                        } catch (s) {
                            B.html("")
                        }
                        if (B.removeClass("elfinder-cwd-view-icons elfinder-cwd-view-list").addClass("elfinder-cwd-view-" + (i ? "list" : "icons")), K[i ? "addClass" : "removeClass"]("elfinder-cwd-wrapper-list"), i && B.html('<table><thead><tr class="ui-state-default"><td class="elfinder-cwd-view-th-name">' + V.name + '</td><td class="elfinder-cwd-view-th-perm">' + V.perm + '</td><td class="elfinder-cwd-view-th-date">' + V.mod + '</td><td class="elfinder-cwd-view-th-size">' + V.size + '</td><td class="elfinder-cwd-view-th-kind">' + V.kind + "</td></tr></thead><tbody/></table>"), E = e.map(r, function(e) {
                                return a || e.phash == o ? e : null
                            }), E = t.sortFiles(E), K.bind(j, R).trigger(j), o = t.cwd().phash, n.oldSchool && o && !y) {
                            var l = e.extend(!0, {}, t.file(o), {
                                name: "..",
                                mime: "directory"
                            });
                            l = e(I(l)).addClass("elfinder-cwd-parent").bind("mousedown click mouseup touchstart touchmove touchend dblclick mouseenter", function(e) {
                                e.preventDefault(), e.stopPropagation()
                            }).dblclick(function() {
                                t.exec("open", this.id)
                            }), (i ? B.find("tbody") : B).prepend(l)
                        }
                    },
                    B = e(this).addClass("ui-helper-clearfix elfinder-cwd").attr("unselectable", "on").delegate(c, "click." + t.namespace, function(n) {
                        var i, o = this.id ? e(this) : e(this).parents("[id]:first"),
                            s = o.prevAll("." + p + ":first"),
                            l = o.nextAll("." + p + ":first"),
                            d = s.length,
                            c = l.length;
                        if (B.data("longtap")) return n.stopPropagation(), void 0;
                        if (n.stopImmediatePropagation(), n.shiftKey && (d || c)) i = d ? o.prevUntil("#" + s.attr("id")) : o.nextUntil("#" + l.attr("id")), i.add(o).trigger(r);
                        else if (n.ctrlKey || n.metaKey) o.trigger(o.is("." + p) ? a : r);
                        else {
                            if (o.data("touching") && o.is("." + p)) return o.data("touching", null), t.dblclick({
                                file: this.id
                            }), D(), void 0;
                            D(), o.trigger(r)
                        }
                        M()
                    }).delegate(c, "dblclick." + t.namespace, function() {
                        t.dblclick({
                            file: this.id
                        })
                    }).delegate(c, "touchstart." + t.namespace, function(n) {
                        if (n.stopPropagation(), "INPUT" != n.target.nodeName) {
                            var i = this.id ? e(this) : e(this).parents("[id]:first"),
                                o = i.prevAll("." + p + ":first").length + i.nextAll("." + p + ":first").length;
                            B.data("longtap", null), i.data("touching", !0), i.data("tmlongtap", setTimeout(function() {
                                B.data("longtap", !0), i.is("." + p) && o > 0 ? (i.trigger(a), M()) : ("TD" != n.target.nodeName || t.selected().length > 0) && (i.trigger(r), M(), i.trigger(t.trigger("contextmenu", {
                                    type: "files",
                                    targets: t.selected(),
                                    x: n.originalEvent.touches[0].clientX,
                                    y: n.originalEvent.touches[0].clientY
                                })))
                            }, 500))
                        }
                    }).delegate(c, "touchmove." + t.namespace + " touchend." + t.namespace, function(t) {
                        if (t.stopPropagation(), "INPUT" != t.target.nodeName) {
                            var n = this.id ? e(this) : e(this).parents("[id]:first");
                            clearTimeout(n.data("tmlongtap"))
                        }
                    }).delegate(c, "mouseenter." + t.namespace, function() {
                        var n = e(this),
                            r = i ? n : n.children();
                        n.is("." + v) || r.is("." + h + ",." + u) || r.draggable(t.draggable)
                    }).delegate(c, r, function() {
                        var t = e(this),
                            n = t.attr("id");
                        F || t.is("." + u) || (t.addClass(p).children().addClass(m), -1 === e.inArray(n, z) && z.push(n))
                    }).delegate(c, a, function() {
                        var t, n = e(this),
                            i = n.attr("id");
                        F || (e(this).removeClass(p).children().removeClass(m), t = e.inArray(i, z), -1 !== t && z.splice(t, 1))
                    }).delegate(c, o, function() {
                        var t = e(this).removeClass(p).addClass(u),
                            n = (i ? t : t.children()).removeClass(m);
                        t.is("." + f) && t.droppable("disable"), n.is("." + h) && n.draggable("disable"), !i && n.removeClass(u)
                    }).delegate(c, s, function() {
                        var t = e(this).removeClass(u),
                            n = i ? t : t.children();
                        t.is("." + f) && t.droppable("enable"), n.is("." + h) && n.draggable("enable")
                    }).delegate(c, "scrolltoview", function() {
                        S(e(this))
                    }).delegate(c, "mouseenter." + t.namespace + " mouseleave." + t.namespace, function(n) {
                        t.trigger("hover", {
                            hash: e(this).attr("id"),
                            type: n.type
                        }), e(this).toggleClass("ui-state-hover")
                    }).bind("contextmenu." + t.namespace, function(n) {
                        var i = e(n.target).closest("." + d);
                        i.length && ("TD" != n.target.nodeName || e.inArray(i.get(0).id, t.selected()) > -1) && (n.stopPropagation(), n.preventDefault(), i.is("." + u) || i.data("touching") || (i.is("." + p) || (D(), i.trigger(r), M()), t.trigger("contextmenu", {
                            type: "files",
                            targets: t.selected(),
                            x: n.clientX,
                            y: n.clientY
                        })))
                    }).bind("click." + t.namespace, function(e) {
                        return B.data("longtap") ? (e.stopPropagation(), void 0) : (!e.shiftKey && !e.ctrlKey && !e.metaKey && D(), void 0)
                    }).selectable({
                        filter: c,
                        stop: M,
                        delay: 250,
                        selected: function(t, n) {
                            e(n.selected).trigger(r)
                        },
                        unselected: function(t, n) {
                            e(n.unselected).trigger(a)
                        }
                    }).droppable(q).bind("create." + t.namespace, function(t, n) {
                        var r = i ? B.find("tbody") : B,
                            a = r.find(".elfinder-cwd-parent"),
                            n = e(I(n)).addClass(v);
                        D(), a.length ? a.after(n) : r.prepend(n), B.scrollTop(0)
                    }).bind("unselectall", D).bind("selectfile", function(e, t) {
                        B.find("#" + t).trigger(r), M()
                    }),
                    K = e('<div class="elfinder-cwd-wrapper"/>').bind("contextmenu", function(e) {
                        e.preventDefault(), t.trigger("contextmenu", {
                            type: "cwd",
                            targets: [t.cwd().hash],
                            x: e.clientX,
                            y: e.clientY
                        })
                    }).bind("touchstart." + t.namespace, function(n) {
                        var i = e(this);
                        B.data("longtap", null), i.data("touching", !0), i.data("tmlongtap", setTimeout(function() {
                            B.data("longtap", !0), t.trigger("contextmenu", {
                                type: "cwd",
                                targets: [t.cwd().hash],
                                x: n.originalEvent.touches[0].clientX,
                                y: n.originalEvent.touches[0].clientY
                            })
                        }, 500))
                    }).bind("touchmove." + t.namespace + " touchend." + t.namespace, function() {
                        clearTimeout(e(this).data("tmlongtap"))
                    }),
                    J = function() {
                        var t = 0;
                        K.siblings(".elfinder-panel:visible").each(function() {
                            t += e(this).outerHeight(!0)
                        }), K.height(X.height() - t)
                    },
                    G = e(this).parent().resize(J),
                    X = G.children(".elfinder-workzone").append(K.append(this));
                e("body").on("touchstart touchmove touchend", function() {}), t.dragUpload && (K[0].addEventListener("dragenter", function(e) {
                    e.preventDefault(), e.stopPropagation(), K.addClass(g)
                }, !1), K[0].addEventListener("dragleave", function(e) {
                    e.preventDefault(), e.stopPropagation(), e.target == B[0] && K.removeClass(g)
                }, !1), K[0].addEventListener("dragover", function(e) {
                    e.preventDefault(), e.stopPropagation()
                }, !1), K[0].addEventListener("drop", function(e) {
                    e.preventDefault(), K.removeClass(g), e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length && t.exec("upload", {
                        files: e.dataTransfer.files
                    })
                }, !1)), t.bind("open", function(e) {
                    $(e.data.files)
                }).bind("search", function(e) {
                    w = e.data.files, $(w, !0)
                }).bind("searchend", function() {
                    w = [], y && (y = "", $(t.files()))
                }).bind("searchstart", function(e) {
                    y = e.data.query
                }).bind("sortchange", function() {
                    $(y ? w : t.files(), !!y)
                }).bind("viewchange", function() {
                    var n = t.selected(),
                        r = "list" == t.storage("view");
                    r != i && (i = r, $(y ? w : t.files(), !!y), e.each(n, function(e, t) {
                        A(t)
                    }), M()), J()
                }).add(function(n) {
                    var i = t.cwd().hash,
                        r = y ? e.map(n.data.added || [], function(e) {
                            return -1 === e.name.indexOf(y) ? null : e
                        }) : e.map(n.data.added || [], function(e) {
                            return e.phash == i ? e : null
                        });
                    _(r)
                }).change(function(n) {
                    var i = t.cwd().hash,
                        r = t.selected();
                    y ? e.each(n.data.changed || [], function(t, n) {
                        W([n.hash]), -1 !== n.name.indexOf(y) && (_([n]), -1 !== e.inArray(n.hash, r) && A(n.hash))
                    }) : e.each(e.map(n.data.changed || [], function(e) {
                        return e.phash == i ? e : null
                    }), function(t, n) {
                        W([n.hash]), _([n]), -1 !== e.inArray(n.hash, r) && A(n.hash)
                    }), M()
                }).remove(function(e) {
                    W(e.data.removed || []), M()
                }).bind("open add search searchend", function() {
                    B.css("height", "auto"), B.outerHeight(!0) < K.height() && B.height(K.height() - (B.outerHeight(!0) - B.height()) - 2)
                }).dragstart(function(t) {
                    var n = e(t.data.target),
                        i = t.data.originalEvent;
                    n.is(c) && (n.is("." + p) || (!(i.ctrlKey || i.metaKey || i.shiftKey) && D(), n.trigger(r), M()), B.droppable("disable")), B.selectable("disable").removeClass(u), F = !0
                }).dragstop(function() {
                    B.selectable("enable").droppable("enable"), F = !1
                }).bind("lockfiles unlockfiles", function(e) {
                    for (var t = "lockfiles" == e.type ? o : s, n = e.data.files || [], i = n.length; i--;) B.find("#" + n[i]).trigger(t);
                    M()
                }).bind("mkdir mkfile duplicate upload rename archive extract", function(n) {
                    var i = t.cwd().hash;
                    D(), e.each(n.data.added || [], function(e, t) {
                        t && t.phash == i && A(t.hash)
                    }), M()
                }).shortcut({
                    pattern: "ctrl+a",
                    description: "selectall",
                    callback: O
                }).shortcut({
                    pattern: "left right up down shift+left shift+right shift+up shift+down",
                    description: "selectfiles",
                    type: "keydown",
                    callback: function(e) {
                        P(e.keyCode, e.shiftKey)
                    }
                }).shortcut({
                    pattern: "home",
                    description: "selectffile",
                    callback: function() {
                        D(), S(B.find("[id]:first").trigger(r)), M()
                    }
                }).shortcut({
                    pattern: "end",
                    description: "selectlfile",
                    callback: function() {
                        D(), S(B.find("[id]:last").trigger(r)), M()
                    }
                })
            }), this
        }, e.fn.elfinderdialog = function(t) {
            var n;
            return "string" == typeof t && (n = this.closest(".ui-dialog")).length && ("open" == t ? "none" == n.css("display") && n.fadeIn(120, function() {
                n.trigger("open")
            }) : "close" == t ? "none" != n.css("display") && n.hide().trigger("close") : "destroy" == t ? n.hide().remove() : "toTop" == t && n.trigger("totop")), t = e.extend({}, e.fn.elfinderdialog.defaults, t), this.filter(":not(.ui-dialog-content)").each(function() {
                var n, i = e(this).addClass("ui-dialog-content ui-widget-content"),
                    r = i.parent(),
                    a = "elfinder-dialog-active",
                    o = "elfinder-dialog",
                    s = "elfinder-dialog-notify",
                    l = "ui-state-hover",
                    d = parseInt(1e6 * Math.random()),
                    c = r.children(".elfinder-overlay"),
                    p = e('<div class="ui-dialog-buttonset"/>'),
                    u = e('<div class=" ui-helper-clearfix ui-dialog-buttonpane ui-widget-content"/>').append(p),
                    h = e('<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable std42-dialog  ' + o + " " + t.cssClass + '"/>').hide().append(i).appendTo(r).draggable({
                        handle: ".ui-dialog-titlebar",
                        containment: "document"
                    }).css({
                        width: t.width,
                        height: t.height
                    }).mousedown(function(t) {
                        t.stopPropagation(), e(document).mousedown(), h.is("." + a) || (r.find("." + o + ":visible").removeClass(a), h.addClass(a).zIndex(f() + 1))
                    }).bind("open", function() {
                        h.trigger("totop"), "function" == typeof t.open && e.proxy(t.open, i[0])(), h.is("." + s) || r.find("." + o + ":visible").not("." + s).each(function() {
                            var t = e(this),
                                n = parseInt(t.css("top")),
                                i = parseInt(t.css("left")),
                                r = parseInt(h.css("top")),
                                a = parseInt(h.css("left"));
                            t[0] == h[0] || n != r && i != a || h.css({
                                top: n + 10 + "px",
                                left: i + 10 + "px"
                            })
                        })
                    }).bind("close", function() {
                        var n = r.find(".elfinder-dialog:visible"),
                            a = f();
                        e(this).data("modal") && c.elfinderoverlay("hide"), n.length ? n.each(function() {
                            var t = e(this);
                            return t.zIndex() >= a ? (t.trigger("totop"), !1) : void 0
                        }) : setTimeout(function() {
                            r.mousedown().click()
                        }, 10), "function" == typeof t.close ? e.proxy(t.close, i[0])() : t.destroyOnClose && h.hide().remove()
                    }).bind("totop", function() {
                        e(this).mousedown().find(".ui-button:first").focus().end().find(":text:first").focus(), e(this).data("modal") && c.elfinderoverlay("show"), c.zIndex(e(this).zIndex())
                    }).data({
                        modal: t.modal
                    }),
                    f = function() {
                        var t = r.zIndex() + 10;
                        return r.find("." + o + ":visible").each(function() {
                            var n;
                            this != h[0] && (n = e(this).zIndex(), n > t && (t = n))
                        }), t
                    };
                t.position || (n = parseInt((r.height() - h.outerHeight()) / 2 - 42), t.position = {
                    top: (n > 0 ? n : 0) + "px",
                    left: parseInt((r.width() - h.outerWidth()) / 2) + "px"
                }), h.css(t.position), t.closeOnEscape && e(document).bind("keyup." + d, function(t) {
                    t.keyCode == e.ui.keyCode.ESCAPE && h.is("." + a) && (i.elfinderdialog("close"), e(document).unbind("keyup." + d))
                }), h.prepend(e('<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">' + t.title + "</div>").prepend(e('<a href="#" class="ui-dialog-titlebar-close ui-corner-all"><span class="ui-icon ui-icon-closethick"/></a>').mousedown(function(e) {
                    e.preventDefault(), i.elfinderdialog("close")
                }))), e.each(t.buttons, function(t, n) {
                    var r = e('<button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">' + t + "</span></button>").click(e.proxy(n, i[0])).hover(function(t) {
                        e(this)["mouseenter" == t.type ? "focus" : "blur"]()
                    }).focus(function() {
                        e(this).addClass(l)
                    }).blur(function() {
                        e(this).removeClass(l)
                    }).keydown(function(t) {
                        var n;
                        t.keyCode == e.ui.keyCode.ENTER ? e(this).click() : t.keyCode == e.ui.keyCode.TAB && (n = e(this).next(".ui-button"), n.length ? n.focus() : e(this).parent().children(".ui-button:first").focus())
                    });
                    p.append(r)
                }), p.children().length && h.append(u), t.resizable && e.fn.resizable && h.resizable({
                    minWidth: t.minWidth,
                    minHeight: t.minHeight,
                    alsoResize: this
                }), "function" == typeof t.create && e.proxy(t.create, this)(), t.autoOpen && i.elfinderdialog("open")
            }), this
        }, e.fn.elfinderdialog.defaults = {
            cssClass: "",
            title: "",
            modal: !1,
            resizable: !0,
            autoOpen: !0,
            closeOnEscape: !0,
            destroyOnClose: !1,
            buttons: {},
            position: null,
            width: 320,
            height: "auto",
            minWidth: 200,
            minHeight: 110
        }, e.fn.elfindernavbar = function(t, n) {
            return this.not(".elfinder-navbar").each(function() {
                var i, r = e(this).addClass("ui-state-default elfinder-navbar"),
                    a = r.parent().resize(function() {
                        r.height(o.height() - s)
                    }),
                    o = a.children(".elfinder-workzone").append(r),
                    s = r.outerHeight() - r.height(),
                    l = "ltr" == t.direction;
                e.fn.resizable && (i = r.resizable({
                    handles: l ? "e" : "w",
                    minWidth: n.minWidth || 150,
                    maxWidth: n.maxWidth || 500
                }).bind("resize scroll", function() {
                    var e = t.UA.Opera && r.scrollLeft() ? 20 : 2;
                    i.css({
                        top: parseInt(r.scrollTop()) + "px",
                        left: l ? "auto" : parseInt(r.scrollLeft() + e),
                        right: l ? -1 * parseInt(r.scrollLeft() - e) : "auto"
                    })
                }).find(".ui-resizable-handle").zIndex(r.zIndex() + 10), l || r.resize(function() {
                    r.css("left", null).css("right", 0)
                }), t.one("open", function() {
                    setTimeout(function() {
                        r.trigger("resize")
                    }, 150)
                }))
            }), this
        }, e.fn.elfinderoverlay = function(t) {
            if (this.filter(":not(.elfinder-overlay)").each(function() {
                    t = e.extend({}, t), e(this).addClass("ui-widget-overlay elfinder-overlay").hide().mousedown(function(e) {
                        e.preventDefault(), e.stopPropagation()
                    }).data({
                        cnt: 0,
                        show: "function" == typeof t.show ? t.show : function() {},
                        hide: "function" == typeof t.hide ? t.hide : function() {}
                    })
                }), "show" == t) {
                var n = this.eq(0),
                    i = n.data("cnt") + 1,
                    r = n.data("show");
                n.data("cnt", i), n.is(":hidden") && (n.zIndex(n.parent().zIndex() + 1), n.show(), r())
            }
            if ("hide" == t) {
                var n = this.eq(0),
                    i = n.data("cnt") - 1,
                    a = n.data("hide");
                n.data("cnt", i), 0 == i && n.is(":visible") && (n.hide(), a())
            }
            return this
        }, e.fn.elfinderpanel = function(t) {
            return this.each(function() {
                var n = e(this).addClass("elfinder-panel ui-state-default ui-corner-all"),
                    i = "margin-" + ("ltr" == t.direction ? "left" : "right");
                t.one("load", function() {
                    var e = t.getUI("navbar");
                    n.css(i, parseInt(e.outerWidth(!0))), e.bind("resize", function() {
                        n.is(":visible") && n.css(i, parseInt(e.outerWidth(!0)))
                    })
                })
            })
        }, e.fn.elfinderpath = function(t) {
            return this.each(function() {
                var n = e(this).addClass("elfinder-path").html("&nbsp;").delegate("a", "click", function(n) {
                    var i = e(this).attr("href").substr(1);
                    n.preventDefault(), i != t.cwd().hash && t.exec("open", i)
                }).prependTo(t.getUI("statusbar").show());
                t.bind("open searchend", function() {
                    var i = [];
                    e.each(t.parents(t.cwd().hash), function(e, n) {
                        i.push('<a href="#' + n + '">' + t.escape(t.file(n).name) + "</a>")
                    }), n.html(i.join(t.option("separator")))
                }).bind("search", function() {
                    n.html(t.i18n("searcresult"))
                })
            })
        }, e.fn.elfinderplaces = function(t, n) {
            return this.each(function() {
                var i = [],
                    r = "class",
                    a = t.res(r, "navdir"),
                    o = t.res(r, "navcollapse"),
                    s = t.res(r, "navexpand"),
                    l = (t.res(r, "hover"), t.res(r, "treeroot")),
                    d = t.res("tpl", "navdir"),
                    c = t.res("tpl", "perms"),
                    p = e(t.res("tpl", "navspinner")),
                    u = function(e) {
                        return e.substr(6)
                    },
                    h = function(e) {
                        return "place-" + e
                    },
                    f = function() {
                        t.storage("places", i.join(","))
                    },
                    m = function(n) {
                        return e(d.replace(/\{id\}/, h(n.hash)).replace(/\{name\}/, t.escape(n.name)).replace(/\{cssclass\}/, t.perms2class(n)).replace(/\{permissions\}/, n.read && n.write ? "" : c).replace(/\{symlink\}/, ""))
                    },
                    g = function(n) {
                        t.files().hasOwnProperty(n.hash) || t.trigger("tree", {
                            tree: [n]
                        });
                        var r = m(n);
                        w.children().length && e.each(w.children(), function() {
                            var t = e(this);
                            return n.name.localeCompare(t.children("." + a).text()) < 0 ? !r.insertBefore(t) : void 0
                        }), i.push(n.hash), !r.parent().length && w.append(r), y.addClass(o), r.draggable({
                            appendTo: "body",
                            revert: !1,
                            helper: function() {
                                var n = e(this);
                                return n.children().removeClass("ui-state-hover"), e('<div class="elfinder-place-drag elfinder-' + t.direction + '"/>').append(n.clone()).data("hash", u(n.children(":first").attr("id")))
                            },
                            start: function() {
                                e(this).hide()
                            },
                            stop: function(t, n) {
                                var i = x.offset().top,
                                    r = x.offset().left,
                                    a = x.width(),
                                    o = x.height(),
                                    s = t.clientX,
                                    l = t.clientY;
                                s > r && r + a > s && l > i && l + o > l ? e(this).show() : (v(n.helper.data("hash")), f())
                            }
                        })
                    },
                    v = function(t) {
                        var n = e.inArray(t, i); - 1 !== n && (i.splice(n, 1), w.find("#" + h(t)).parent().remove(), !w.children().length && y.removeClass(o + " " + s))
                    },
                    b = m({
                        hash: "root-" + t.namespace,
                        name: t.i18n(n.name, "places"),
                        read: !0,
                        write: !0
                    }),
                    y = b.children("." + a).addClass(l).click(function() {
                        y.is("." + o) && (x.toggleClass(s), w.slideToggle(), t.storage("placesState", x.is("." + s) ? 1 : 0))
                    }),
                    w = b.children("." + t.res(r, "navsubtree")),
                    x = e(this).addClass(t.res(r, "tree") + " elfinder-places ui-corner-all").hide().append(b).appendTo(t.getUI("navbar")).delegate("." + a, "hover", function() {
                        e(this).toggleClass("ui-state-hover")
                    }).delegate("." + a, "click", function() {
                        t.exec("open", e(this).attr("id").substr(6))
                    }).delegate("." + a + ":not(." + l + ")", "contextmenu", function(n) {
                        var i = e(this).attr("id").substr(6);
                        n.preventDefault(), t.trigger("contextmenu", {
                            raw: [{
                                label: t.i18n("rmFromPlaces"),
                                icon: "rm",
                                callback: function() {
                                    v(i), f()
                                }
                            }],
                            x: n.clientX,
                            y: n.clientY
                        })
                    }).droppable({
                        tolerance: "pointer",
                        accept: ".elfinder-cwd-file-wrapper,.elfinder-tree-dir,.elfinder-cwd-file",
                        hoverClass: t.res("class", "adroppable"),
                        drop: function(n, r) {
                            var a = !0;
                            e.each(r.helper.data("files"), function(n, r) {
                                var o = t.file(r);
                                o && "directory" == o.mime && -1 === e.inArray(o.hash, i) ? g(o) : a = !1
                            }), f(), a && r.helper.hide()
                        }
                    });
                t.one("load", function() {
                    t.oldAPI || (x.show().parent().show(), i = e.map((t.storage("places") || "").split(","), function(e) {
                        return e || null
                    }), i.length && (y.prepend(p), t.request({
                        data: {
                            cmd: "info",
                            targets: i
                        },
                        preventDefault: !0
                    }).done(function(n) {
                        i = [], e.each(n.files, function(e, t) {
                            "directory" == t.mime && g(t)
                        }), f(), t.storage("placesState") > 0 && y.click()
                    }).always(function() {
                        p.remove()
                    })), t.remove(function(t) {
                        e.each(t.data.removed, function(e, t) {
                            v(t)
                        }), f()
                    }).change(function(t) {
                        e.each(t.data.changed, function(t, n) {
                            -1 !== e.inArray(n.hash, i) && (v(n.hash), "directory" == n.mime && g(n))
                        }), f()
                    }).bind("sync", function() {
                        i.length && (y.prepend(p), t.request({
                            data: {
                                cmd: "info",
                                targets: i
                            },
                            preventDefault: !0
                        }).done(function(t) {
                            e.each(t.files || [], function(t, n) {
                                -1 === e.inArray(n.hash, i) && v(n.hash)
                            }), f()
                        }).always(function() {
                            p.remove()
                        }))
                    }))
                })
            })
        }, e.fn.elfindersearchbutton = function(t) {
            return this.each(function() {
                var n = !1,
                    i = e(this).hide().addClass("ui-widget-content elfinder-button " + t.fm.res("class", "searchbtn")),
                    r = function() {
                        var i = e.trim(o.val());
                        i ? t.exec(i).done(function() {
                            n = !0, o.focus()
                        }) : t.fm.trigger("searchend")
                    },
                    a = function() {
                        o.val(""), n && (n = !1, t.fm.trigger("searchend"))
                    },
                    o = e('<input type="text" size="42"/>').appendTo(i).keypress(function(e) {
                        e.stopPropagation()
                    }).keydown(function(e) {
                        e.stopPropagation(), 13 == e.keyCode && r(), 27 == e.keyCode && (e.preventDefault(), a())
                    });
                e('<span class="ui-icon ui-icon-search" title="' + t.title + '"/>').appendTo(i).click(r), e('<span class="ui-icon ui-icon-close"/>').appendTo(i).click(a), setTimeout(function() {
                    if (i.parent().detach(), t.fm.getUI("toolbar").prepend(i.show()), t.fm.UA.ltIE7) {
                        var e = i.children("ltr" == t.fm.direction ? ".ui-icon-close" : ".ui-icon-search");
                        e.css({
                            right: "",
                            left: parseInt(i.width()) - e.outerWidth(!0)
                        })
                    }
                }, 200), t.fm.select(function() {
                    o.blur()
                }).bind("searchend", function() {
                    o.val("")
                }).shortcut({
                    pattern: "ctrl+f f3",
                    description: t.title,
                    callback: function() {
                        o.select().focus()
                    }
                })
            })
        }, e.fn.elfindersortbutton = function(t) {
            return this.each(function() {
                var n = t.fm,
                    i = t.name,
                    r = "class",
                    a = n.res(r, "disabled"),
                    o = n.res(r, "hover"),
                    s = "elfinder-button-menu-item",
                    l = s + "-selected",
                    d = l + "-asc",
                    c = l + "-desc",
                    p = e(this).addClass("ui-state-default elfinder-button elfinder-menubutton elfiner-button-" + i).attr("title", t.title).append('<span class="elfinder-button-icon elfinder-button-icon-' + i + '"/>').hover(function() {
                        !p.is("." + a) && p.toggleClass(o)
                    }).click(function(e) {
                        p.is("." + a) || (e.stopPropagation(), u.is(":hidden") && t.fm.getUI().click(), u.slideToggle(100))
                    }),
                    u = e('<div class="ui-widget ui-widget-content elfinder-button-menu ui-corner-all"/>').hide().appendTo(p).zIndex(12 + p.zIndex()).delegate("." + s, "hover", function() {
                        e(this).toggleClass(o)
                    }).delegate("." + s, "click", function(e) {
                        e.preventDefault(), e.stopPropagation(), f()
                    }),
                    h = function() {
                        u.children(":not(:last)").removeClass(l + " " + d + " " + c).filter('[rel="' + n.sortType + '"]').addClass(l + " " + ("asc" == n.sortOrder ? d : c)), u.children(":last").toggleClass(l, n.sortStickFolders)
                    },
                    f = function() {
                        u.hide()
                    };
                e.each(n.sortRules, function(t) {
                    u.append(e('<div class="' + s + '" rel="' + t + '"><span class="ui-icon ui-icon-arrowthick-1-n"/><span class="ui-icon ui-icon-arrowthick-1-s"/>' + n.i18n("sort" + t) + "</div>").data("type", t))
                }), u.children().click(function() {
                    var i = e(this).attr("rel");
                    t.exec([], {
                        type: i,
                        order: i == n.sortType ? "asc" == n.sortOrder ? "desc" : "asc" : n.sortOrder,
                        stick: n.sortStickFolders
                    })
                }), e('<div class="' + s + " " + s + '-separated"><span class="ui-icon ui-icon-check"/>' + n.i18n("sortFoldersFirst") + "</div>").appendTo(u).click(function() {
                    t.exec([], {
                        type: n.sortType,
                        order: n.sortOrder,
                        stick: !n.sortStickFolders
                    })
                }), n.bind("disable select", f).getUI().click(f), n.bind("sortchange", h), u.children().length > 1 ? t.change(function() {
                    p.toggleClass(a, t.disabled()), h()
                }).change() : p.addClass(a)
            })
        }, e.fn.elfinderstat = function(t) {
            return this.each(function() {
                var n = e(this).addClass("elfinder-stat-size"),
                    i = e('<div class="elfinder-stat-selected"/>'),
                    r = t.i18n("size").toLowerCase(),
                    a = t.i18n("items").toLowerCase(),
                    o = t.i18n("selected"),
                    s = function(i, o) {
                        var s = 0,
                            l = 0;
                        e.each(i, function(e, t) {
                            o && t.phash != o || (s++, l += parseInt(t.size) || 0)
                        }), n.html(a + ": " + s + ", " + r + ": " + t.formatSize(l))
                    };
                t.getUI("statusbar").prepend(n).append(i).show(), t.bind("open reload add remove change searchend", function() {
                    s(t.files(), t.cwd().hash)
                }).search(function(e) {
                    s(e.data.files)
                }).select(function() {
                    var n = 0,
                        a = 0,
                        s = t.selectedFiles();
                    return 1 == s.length ? (n = s[0].size, i.html(t.escape(s[0].name) + (n > 0 ? ", " + t.formatSize(n) : "")), void 0) : (e.each(s, function(e, t) {
                        a++, n += parseInt(t.size) || 0
                    }), i.html(a ? o + ": " + a + ", " + r + ": " + t.formatSize(n) : "&nbsp;"), void 0)
                })
            })
        }, e.fn.elfindertoolbar = function(t, n) {
            return this.not(".elfinder-toolbar").each(function() {
                var i, r, a, o, s = t._commands,
                    l = e(this).addClass("ui-helper-clearfix ui-widget-header ui-corner-top elfinder-toolbar"),
                    d = n || [],
                    c = d.length;
                for (l.prev().length && l.parent().prepend(this); c--;)
                    if (d[c]) {
                        for (a = e('<div class="ui-widget-content ui-corner-all elfinder-buttonset"/>'), i = d[c].length; i--;)(r = s[d[c][i]]) && (o = "elfinder" + r.options.ui, e.fn[o] && a.prepend(e("<div/>")[o](r)));
                        a.children().length && l.prepend(a), a.children(":gt(0)").before('<span class="ui-widget-content elfinder-toolbar-button-separator"/>')
                    }
                l.children().length && l.show()
            }), this
        }, e.fn.elfindertree = function(t, n) {
            var i = t.res("class", "tree");
            return this.not("." + i).each(function() {
                var r = "class",
                    a = t.res(r, "treeroot"),
                    o = n.openRootOnLoad,
                    s = t.res(r, "navsubtree"),
                    l = t.res(r, "treedir"),
                    d = t.res(r, "navcollapse"),
                    c = t.res(r, "navexpand"),
                    p = "elfinder-subtree-loaded",
                    u = t.res(r, "navarrow"),
                    h = t.res(r, "active"),
                    f = t.res(r, "adroppable"),
                    m = t.res(r, "hover"),
                    g = t.res(r, "disabled"),
                    v = t.res(r, "draggable"),
                    b = t.res(r, "droppable"),
                    y = function(e) {
                        var t = j.offset().left;
                        return e >= t && e <= t + j.width()
                    },
                    w = t.droppable.drop,
                    x = e.extend(!0, {}, t.droppable, {
                        over: function(t) {
                            var n = e(this),
                                i = m + " " + f;
                            y(t.clientX) ? (n.addClass(i), n.is("." + d + ":not(." + c + ")") && setTimeout(function() {
                                n.is("." + f) && n.children("." + u).click()
                            }, 500)) : n.removeClass(i)
                        },
                        out: function() {
                            e(this).removeClass(m + " " + f)
                        },
                        drop: function(e, t) {
                            y(e.clientX) && w.call(this, e, t)
                        }
                    }),
                    k = e(t.res("tpl", "navspinner")),
                    C = t.res("tpl", "navdir"),
                    T = t.res("tpl", "perms"),
                    I = t.res("tpl", "symlink"),
                    F = {
                        id: function(e) {
                            return t.navHash2Id(e.hash)
                        },
                        cssclass: function(e) {
                            return (e.phash ? "" : a) + " " + l + " " + t.perms2class(e) + " " + (e.dirs && !e.link ? d : "")
                        },
                        permissions: function(e) {
                            return e.read && e.write ? "" : T
                        },
                        symlink: function(e) {
                            return e.alias ? I : ""
                        }
                    },
                    P = function(e) {
                        return e.name = t.escape(e.i18 || e.name), C.replace(/(?:\{([a-z]+)\})/gi, function(t, n) {
                            return e[n] || (F[n] ? F[n](e) : "")
                        })
                    },
                    z = function(t) {
                        return e.map(t || [], function(e) {
                            return "directory" == e.mime ? e : null
                        })
                    },
                    A = function(e) {
                        return e ? U.find("#" + t.navHash2Id(e)).next("." + s) : U
                    },
                    O = function(n, i) {
                        for (var r, a = n.children(":first"); a.length;) {
                            if (r = t.file(t.navId2Hash(a.children("[id]").attr("id"))), (r = t.file(t.navId2Hash(a.children("[id]").attr("id")))) && i.name.toLowerCase().localeCompare(r.name.toLowerCase()) < 0) return a;
                            a = a.next()
                        }
                        return e("")
                    },
                    D = function(e) {
                        for (var n, i, r, a, o = e.length, s = [], l = e.length, d = !0; l--;) n = e[l], U.find("#" + t.navHash2Id(n.hash)).length || ((r = A(n.phash)).length ? (i = P(n), n.phash && (a = O(r, n)).length ? a.before(i) : (r[d || n.phash ? "append" : "prepend"](i), d = !1)) : s.push(n));
                        return s.length && s.length < o ? D(s) : (setTimeout(function() {
                            S()
                        }, 10), void 0)
                    },
                    M = function() {
                        var e, i, r = t.cwd().hash,
                            d = U.find("#" + t.navHash2Id(r));
                        if (o && (e = U.find("#" + t.navHash2Id(t.root())), e.is("." + p) && e.addClass(c).next("." + s).show(), o = !1), d.is("." + h) || (U.find("." + l + "." + h).removeClass(h), d.addClass(h)), n.syncTree) {
                            if (d.length) return d.parentsUntil("." + a).filter("." + s).show().prev("." + l).addClass(c);
                            if (t.newAPI) {
                                if (i = t.file(r), i && i.phash && U.find("#" + t.navHash2Id(i.phash)).length) return D([i]), M();
                                t.request({
                                    data: {
                                        cmd: "parents",
                                        target: r
                                    },
                                    preventFail: !0
                                }).done(function(e) {
                                    var n = z(e.tree);
                                    D(n), E(n, p), r == t.cwd().hash && M(!0)
                                })
                            }
                        }
                    },
                    S = function() {
                        U.find("." + l + ":not(." + b + ",.elfinder-ro,.elfinder-na)").droppable(x)
                    },
                    E = function(n, i) {
                        var r = i == p ? "." + d + ":not(." + p + ")" : ":not(." + d + ")";
                        e.each(n, function(n, a) {
                            U.find("#" + t.navHash2Id(a.phash) + r).filter(function() {
                                return e(this).next("." + s).children().length > 0
                            }).addClass(i)
                        })
                    },
                    U = e(this).addClass(i).delegate("." + l, "hover", function(n) {
                        var i = e(this),
                            r = "mouseenter" == n.type;
                        i.is("." + f + " ,." + g) || (r && !i.is("." + a + ",." + v + ",.elfinder-na,.elfinder-wo") && i.draggable(t.draggable), i.toggleClass(m, r))
                    }).delegate("." + l, "dropover dropout drop", function(t) {
                        e(this)["dropover" == t.type ? "addClass" : "removeClass"](f + " " + m)
                    }).delegate("." + l, "click", function() {
                        var n = e(this),
                            i = t.navId2Hash(n.attr("id")),
                            r = t.file(i);
                        t.trigger("searchend"), i == t.cwd().hash || n.is("." + g) ? n.is("." + d) && n.children("." + u).click() : t.exec("open", r.thash || i)
                    }).delegate("." + l + "." + d + " ." + u, "click", function(n) {
                        var i = e(this),
                            r = i.parent("." + l),
                            a = r.next("." + s);
                        n.stopPropagation(), r.is("." + p) ? (r.toggleClass(c), a.slideToggle()) : (k.insertBefore(i), r.removeClass(d), t.request({
                            cmd: "tree",
                            target: t.navId2Hash(r.attr("id"))
                        }).done(function(e) {
                            D(z(e.tree)), a.children().length && (r.addClass(d + " " + c), a.slideDown()), M()
                        }).always(function() {
                            k.remove(), r.addClass(p)
                        }))
                    }).delegate("." + l, "contextmenu", function(n) {
                        n.preventDefault(), t.trigger("contextmenu", {
                            type: "navbar",
                            targets: [t.navId2Hash(e(this).attr("id"))],
                            x: n.clientX,
                            y: n.clientY
                        })
                    }),
                    j = t.getUI("navbar").append(U).show();
                t.open(function(e) {
                    var t = e.data,
                        n = z(t.files);
                    t.init && U.empty(), n.length && (D(n), E(n, p)), M()
                }).add(function(e) {
                    var t = z(e.data.added);
                    t.length && (D(t), E(t, d))
                }).change(function(n) {
                    for (var i, r, a, o, d, u, h, f, m, g = z(n.data.changed), v = g.length; v--;)
                        if (i = g[v], (r = U.find("#" + t.navHash2Id(i.hash))).length) {
                            if (i.phash) {
                                if (o = r.closest("." + s), d = A(i.phash), u = r.parent().next(), h = O(d, i), !d.length) continue;
                                (d[0] !== o[0] || u.get(0) !== h.get(0)) && (h.length ? h.before(r) : d.append(r))
                            }
                            f = r.is("." + c), m = r.is("." + p), a = e(P(i)), r.replaceWith(a.children("." + l)), i.dirs && (f || m) && (r = U.find("#" + t.navHash2Id(i.hash))) && r.next("." + s).children().length && (f && r.addClass(c), m && r.addClass(p))
                        }
                    M(), S()
                }).remove(function(e) {
                    for (var n, i, r = e.data.removed, a = r.length; a--;)(n = U.find("#" + t.navHash2Id(r[a]))).length && (i = n.closest("." + s), n.parent().detach(), i.children().length || i.hide().prev("." + l).removeClass(d + " " + c + " " + p))
                }).bind("search searchend", function(e) {
                    U.find("#" + t.navHash2Id(t.cwd().hash))["search" == e.type ? "removeClass" : "addClass"](h)
                }).bind("lockfiles unlockfiles", function(n) {
                    var i = "lockfiles" == n.type,
                        r = i ? "disable" : "enable",
                        a = e.map(n.data.files || [], function(e) {
                            var n = t.file(e);
                            return n && "directory" == n.mime ? e : null
                        });
                    e.each(a, function(e, n) {
                        var a = U.find("#" + t.navHash2Id(n));
                        a.length && (a.is("." + v) && a.draggable(r), a.is("." + b) && a.droppable(r), a[i ? "addClass" : "removeClass"](g))
                    })
                })
            }), this
        }, e.fn.elfinderuploadbutton = function(t) {
            return this.each(function() {
                var n = e(this).elfinderbutton(t).unbind("click"),
                    i = e("<form/>").appendTo(n),
                    r = e('<input type="file" multiple="true"/>').change(function() {
                        var n = e(this);
                        n.val() && (t.exec({
                            input: n.remove()[0]
                        }), r.clone(!0).appendTo(i))
                    });
                i.append(r.clone(!0)), t.change(function() {
                    i[t.disabled() ? "hide" : "show"]()
                }).change()
            })
        }, e.fn.elfinderviewbutton = function(t) {
            return this.each(function() {
                var n = e(this).elfinderbutton(t),
                    i = n.children(".elfinder-button-icon");
                t.change(function() {
                    var e = "icons" == t.value;
                    i.toggleClass("elfinder-button-icon-view-list", e), n.attr("title", t.fm.i18n(e ? "viewlist" : "viewicons"))
                })
            })
        }, e.fn.elfinderworkzone = function() {
            var t = "elfinder-workzone";
            return this.not("." + t).each(function() {
                var n = e(this).addClass(t),
                    i = n.outerHeight(!0) - n.height(),
                    r = n.parent();
                r.add(window).bind("resize", function() {
                    var a = r.height();
                    r.children(":visible:not(." + t + ")").each(function() {
                        var t = e(this);
                        "absolute" != t.css("position") && "fixed" != t.css("position") && (a -= t.outerHeight(!0))
                    }), n.height(a - i)
                })
            }), this
        }, elFinder.prototype.commands.archive = function() {
            var t = this,
                n = t.fm,
                i = [];
            this.variants = [], this.disableOnSearch = !0, n.bind("open reload", function() {
                t.variants = [], e.each(i = n.option("archivers").create || [], function(e, i) {
                    t.variants.push([i, n.mime2kind(i)])
                }), t.change()
            }), this.getstate = function() {
                return !this._disabled && i.length && n.selected().length && n.cwd().write ? 0 : -1
            }, this.exec = function(t, r) {
                var a, o = this.files(t),
                    s = o.length,
                    l = r || i[0],
                    d = n.cwd(),
                    c = ["errArchive", "errPerm", "errCreatingTempDir", "errFtpDownloadFile", "errFtpUploadFile", "errFtpMkdir", "errArchiveExec", "errExtractExec", "errRm"],
                    p = e.Deferred().fail(function(e) {
                        e && n.error(e)
                    });
                if (!(this.enabled() && s && i.length && -1 !== e.inArray(l, i))) return p.reject();
                if (!d.write) return p.reject(c);
                for (a = 0; s > a; a++)
                    if (!o[a].read) return p.reject(c);
                return n.request({
                    data: {
                        cmd: "archive",
                        targets: this.hashes(t),
                        type: l
                    },
                    notify: {
                        type: "archive",
                        cnt: 1
                    },
                    syncOnFail: !0
                })
            }
        }, elFinder.prototype.commands.back = function() {
            this.alwaysEnabled = !0, this.updateOnSelect = !1, this.shortcuts = [{
                pattern: "ctrl+left backspace"
            }], this.getstate = function() {
                return this.fm.history.canBack() ? 0 : -1
            }, this.exec = function() {
                return this.fm.history.back()
            }
        }, elFinder.prototype.commands.copy = function() {
            this.shortcuts = [{
                pattern: "ctrl+c ctrl+insert"
            }], this.getstate = function(t) {
                var t = this.files(t),
                    n = t.length;
                return n && e.map(t, function(e) {
                    return e.phash && e.read ? e : null
                }).length == n ? 0 : -1
            }, this.exec = function(t) {
                var n = this.fm,
                    i = e.Deferred().fail(function(e) {
                        n.error(e)
                    });
                return e.each(this.files(t), function(e, t) {
                    return t.read && t.phash ? void 0 : !i.reject(["errCopy", t.name, "errPerm"])
                }), "rejected" == i.state() ? i : i.resolve(n.clipboard(this.hashes(t)))
            }
        }, elFinder.prototype.commands.cut = function() {
            this.shortcuts = [{
                pattern: "ctrl+x shift+insert"
            }], this.getstate = function(t) {
                var t = this.files(t),
                    n = t.length;
                return n && e.map(t, function(e) {
                    return e.phash && e.read && !e.locked ? e : null
                }).length == n ? 0 : -1
            }, this.exec = function(t) {
                var n = this.fm,
                    i = e.Deferred().fail(function(e) {
                        n.error(e)
                    });
                return e.each(this.files(t), function(e, t) {
                    return t.read && t.phash ? t.locked ? !i.reject(["errLocked", t.name]) : void 0 : !i.reject(["errCopy", t.name, "errPerm"])
                }), "rejected" == i.state() ? i : i.resolve(n.clipboard(this.hashes(t), !0))
            }
        }, elFinder.prototype.commands.download = function() {
            var t = this,
                n = this.fm,
                i = function(n) {
                    return e.map(t.files(n), function(e) {
                        return "directory" == e.mime ? null : e
                    })
                };
            this.shortcuts = [{
                pattern: "shift+enter"
            }], this.getstate = function() {
                var e = this.fm.selected(),
                    t = e.length;
                return this._disabled || !t || n.UA.IE && 1 != t || t != i(e).length ? -1 : 0
            }, this.exec = function(t) {
                var n, r = this.fm,
                    a = r.options.url,
                    o = i(t),
                    s = e.Deferred(),
                    l = "",
                    d = "";
                if (this.disabled()) return s.reject();
                if (r.oldAPI) return r.error("errCmdNoSupport"), s.reject();
                for (d = e.param(r.options.customData || {}), d && (d = "&" + d), a += -1 === a.indexOf("?") ? "?" : "&", n = 0; n < o.length; n++) l += '<iframe class="downloader" id="downloader-' + o[n].hash + '" style="display:none" src="' + a + "cmd=file&target=" + o[n].hash + "&download=1" + d + '"/>';
                return e(l).appendTo("body").ready(function() {
                    setTimeout(function() {
                        e(l).each(function() {
                            e("#" + e(this).attr("id")).remove()
                        })
                    }, r.UA.Firefox ? 2e4 + 1e4 * n : 1e3)
                }), r.trigger("download", {
                    files: o
                }), s.resolve(t)
            }
        }, elFinder.prototype.commands.duplicate = function() {
            var t = this.fm;
            this.getstate = function(n) {
                var n = this.files(n),
                    i = n.length;
                return !this._disabled && i && t.cwd().write && e.map(n, function(e) {
                    return e.phash && e.read ? e : null
                }).length == i ? 0 : -1
            }, this.exec = function(t) {
                var n = this.fm,
                    i = this.files(t),
                    r = i.length,
                    a = e.Deferred().fail(function(e) {
                        e && n.error(e)
                    });
                return !r || this._disabled ? a.reject() : (e.each(i, function(e, t) {
                    return t.read && n.file(t.phash).write ? void 0 : !a.reject(["errCopy", t.name, "errPerm"])
                }), "rejected" == a.state() ? a : n.request({
                    data: {
                        cmd: "duplicate",
                        targets: this.hashes(t)
                    },
                    notify: {
                        type: "copy",
                        cnt: r
                    }
                }))
            }
        }, elFinder.prototype.commands.edit = function() {
            var t = this,
                n = this.fm,
                i = n.res("mimes", "text") || [],
                r = function(n) {
                    return e.map(n, function(n) {
                        return 0 !== n.mime.indexOf("text/") && -1 === e.inArray(n.mime, i) || !n.mime.indexOf("text/rtf") || t.onlyMimes.length && -1 === e.inArray(n.mime, t.onlyMimes) || !n.read || !n.write ? null : n
                    })
                },
                a = function(i, r, a) {
                    var o = e.Deferred(),
                        s = e('<textarea class="elfinder-file-edit" rows="20" id="' + i + '-ta">' + n.escape(a) + "</textarea>"),
                        l = function() {
                            s.editor && s.editor.save(s[0], s.editor.instance), o.resolve(s.getContent()), s.elfinderdialog("close")
                        },
                        d = function() {
                            o.reject(), s.elfinderdialog("close")
                        },
                        c = {
                            title: n.escape(r.name),
                            width: t.options.dialogWidth || 450,
                            buttons: {},
                            close: function() {
                                s.editor && s.editor.close(s[0], s.editor.instance), e(this).elfinderdialog("destroy")
                            },
                            open: function() {
                                n.disable(), s.focus(), s[0].setSelectionRange && s[0].setSelectionRange(0, 0), s.editor && (s.editor.instance = s.editor.load(s[0]) || null)
                            }
                        };
                    return s.getContent = function() {
                        return s.val()
                    }, e.each(t.options.editors || [], function(t, n) {
                        return -1 !== e.inArray(r.mime, n.mimes || []) && "function" == typeof n.load && "function" == typeof n.save ? (s.editor = {
                            load: n.load,
                            save: n.save,
                            close: "function" == typeof n.close ? n.close : function() {},
                            instance: null
                        }, !1) : void 0
                    }), s.editor || s.keydown(function(e) {
                        var t, n, i = e.keyCode;
                        e.stopPropagation(), 9 == i && (e.preventDefault(), this.setSelectionRange && (t = this.value, n = this.selectionStart, this.value = t.substr(0, n) + "	" + t.substr(this.selectionEnd), n += 1, this.setSelectionRange(n, n))), (e.ctrlKey || e.metaKey) && ((81 == i || 87 == i) && (e.preventDefault(), d()), 83 == i && (e.preventDefault(), l()))
                    }), c.buttons[n.i18n("Save")] = l, c.buttons[n.i18n("Cancel")] = d, n.dialog(s, c).attr("id", i), o.promise()
                },
                o = function(t) {
                    var i, r = t.hash,
                        o = (n.options, e.Deferred()),
                        s = (n.url(r) || n.options.url, "edit-" + n.namespace + "-" + t.hash),
                        l = n.getUI().find("#" + s);
                    return l.length ? (l.elfinderdialog("toTop"), o.resolve()) : t.read && t.write ? (n.request({
                        data: {
                            cmd: "get",
                            target: r
                        },
                        notify: {
                            type: "openfile",
                            cnt: 1
                        },
                        syncOnFail: !0
                    }).done(function(e) {
                        a(s, t, e.content).done(function(e) {
                            n.request({
                                options: {
                                    type: "post"
                                },
                                data: {
                                    cmd: "put",
                                    target: r,
                                    content: e
                                },
                                notify: {
                                    type: "save",
                                    cnt: 1
                                },
                                syncOnFail: !0
                            }).fail(function(e) {
                                o.reject(e)
                            }).done(function(e) {
                                e.changed && e.changed.length && n.change(e), o.resolve(e)
                            })
                        })
                    }).fail(function(e) {
                        o.reject(e)
                    }), o.promise()) : (i = ["errOpen", t.name, "errPerm"], n.error(i), o.reject(i))
                };
            this.shortcuts = [{
                pattern: "ctrl+e"
            }], this.init = function() {
                this.onlyMimes = this.options.mimes || []
            }, this.getstate = function(e) {
                var e = this.files(e),
                    t = e.length;
                return !this._disabled && t && r(e).length == t ? 0 : -1
            }, this.exec = function(t) {
                var n, i = r(this.files(t)),
                    a = [];
                if (this.disabled()) return e.Deferred().reject();
                for (; n = i.shift();) a.push(o(n));
                return a.length ? e.when.apply(null, a) : e.Deferred().reject()
            }
        }, elFinder.prototype.commands.extract = function() {
            var t = this,
                n = t.fm,
                i = [],
                r = function(t) {
                    return e.map(t, function(t) {
                        return t.read && -1 !== e.inArray(t.mime, i) ? t : null
                    })
                };
            this.disableOnSearch = !0, n.bind("open reload", function() {
                i = n.option("archivers").extract || [], t.change()
            }), this.getstate = function(e) {
                var e = this.files(e),
                    t = e.length;
                return !this._disabled && t && this.fm.cwd().write && r(e).length == t ? 0 : -1
            }, this.exec = function(t) {
                var r, a, o, s = this.files(t),
                    l = e.Deferred(),
                    d = s.length,
                    c = !1,
                    p = !1,
                    u = e.map(n.files(t), function(e) {
                        return e.name
                    }),
                    h = {};
                e.map(n.files(t), function(e) {
                    h[e.name] = e
                });
                var f = function(e) {
                        switch (e) {
                            case "overwrite_all":
                                c = !0;
                                break;
                            case "omit_all":
                                p = !0
                        }
                    },
                    m = function(t) {
                        t.read && n.file(t.phash).write ? -1 === e.inArray(t.mime, i) ? (a = ["errExtract", t.name, "errNoArchive"], n.error(a), l.reject(a)) : n.request({
                            data: {
                                cmd: "extract",
                                target: t.hash
                            },
                            notify: {
                                type: "extract",
                                cnt: 1
                            },
                            syncOnFail: !0
                        }).fail(function(e) {
                            "rejected" != l.state() && l.reject(e)
                        }).done(function() {}) : (a = ["errExtract", t.name, "errPerm"], n.error(a), l.reject(a))
                    },
                    g = function(t, i) {
                        var a = t[i],
                            s = a.name.replace(/\.((tar\.(gz|bz|bz2|z|lzo))|cpio\.gz|ps\.gz|xcf\.(gz|bz2)|[a-z0-9]{1,4})$/gi, ""),
                            v = e.inArray(s, u) >= 0;
                        v && "directory" != h[s].mime ? n.confirm({
                            title: n.i18n("ntfextract"),
                            text: n.i18n(["errExists", s, "confirmRepl"]),
                            accept: {
                                label: "btnYes",
                                callback: function(e) {
                                    if (o = e ? "overwrite_all" : "overwrite", f(o), c || p) {
                                        if (c) {
                                            for (r = 0; d > r; r++) m(t[r]);
                                            l.resolve()
                                        }
                                    } else "overwrite" == o && m(a), d > i + 1 ? g(t, i + 1) : l.resolve()
                                }
                            },
                            reject: {
                                label: "btnNo",
                                callback: function(e) {
                                    o = e ? "omit_all" : "omit", f(o), !c && !p && d > i + 1 ? g(t, i + 1) : p && l.resolve()
                                }
                            },
                            cancel: {
                                label: "btnCancel",
                                callback: function() {
                                    l.resolve()
                                }
                            },
                            all: d > 1
                        }) : (m(a), d > i + 1 ? g(t, i + 1) : l.resolve())
                    };
                return this.enabled() && d && i.length ? (d > 0 && g(s, 0), l) : l.reject()
            }
        }, elFinder.prototype.commands.forward = function() {
            this.alwaysEnabled = !0, this.updateOnSelect = !0, this.shortcuts = [{
                pattern: "ctrl+right"
            }], this.getstate = function() {
                return this.fm.history.canForward() ? 0 : -1
            }, this.exec = function() {
                return this.fm.history.forward()
            }
        }, elFinder.prototype.commands.getfile = function() {
            var t = this,
                n = this.fm,
                i = function(n) {
                    var i = t.options;
                    return n = e.map(n, function(e) {
                        return "directory" != e.mime || i.folders ? e : null
                    }), i.multiple || 1 == n.length ? n : []
                };
            this.alwaysEnabled = !0, this.callback = n.options.getFileCallback, this._disabled = "function" == typeof this.callback, this.getstate = function(e) {
                var e = this.files(e),
                    t = e.length;
                return this.callback && t && i(e).length == t ? 0 : -1
            }, this.exec = function(n) {
                var i, r, a, o = this.fm,
                    s = this.options,
                    l = this.files(n),
                    d = l.length,
                    c = o.option("url"),
                    p = o.option("tmbUrl"),
                    u = e.Deferred().done(function(e) {
                        o.trigger("getfile", {
                            files: e
                        }), t.callback(e, o), "close" == s.oncomplete ? o.hide() : "destroy" == s.oncomplete && o.destroy()
                    }),
                    h = function() {
                        return s.onlyURL ? s.multiple ? e.map(l, function(e) {
                            return e.url
                        }) : l[0].url : s.multiple ? l : l[0]
                    },
                    f = [];
                if (-1 == this.getstate()) return u.reject();
                for (i = 0; d > i; i++) {
                    if (r = l[i], "directory" == r.mime && !s.folders) return u.reject();
                    r.baseUrl = c, r.url = o.url(r.hash), r.path = o.path(r.hash), r.tmb && 1 != r.tmb && (r.tmb = p + r.tmb), r.width || r.height || (r.dim ? (a = r.dim.split("x"), r.width = a[0], r.height = a[1]) : -1 !== r.mime.indexOf("image") && f.push(o.request({
                        data: {
                            cmd: "dim",
                            target: r.hash
                        },
                        notify: {
                            type: "dim",
                            cnt: 1,
                            hideCnt: !0
                        },
                        preventDefault: !0
                    }).done(function(e) {
                        if (e.dim) {
                            var t = e.dim.split("x"),
                                n = o.file(this.hash);
                            n.width = this.width = t[0], n.height = this.height = t[1]
                        }
                    }.bind(r))))
                }
                return f.length ? (e.when.apply(null, f).always(function() {
                    u.resolve(h(l))
                }), u) : u.resolve(h(l))
            }
        }, elFinder.prototype.commands.help = function() {
            var t = this.fm,
                n = this,
                i = '<div class="elfinder-help-link"> <a href="{url}" target="_blank">{link}</a></div>',
                r = '<div class="elfinder-help-team"><div>{author}</div>{work}</div>',
                a = /\{url\}/,
                o = /\{link\}/,
                s = /\{author\}/,
                l = /\{work\}/,
                d = "replace",
                c = "ui-priority-primary",
                p = "ui-priority-secondary",
                u = "elfinder-help-license",
                h = '<li class="ui-state-default ui-corner-top"><a href="#{id}">{title}</a></li>',
                f = ['<div class="ui-tabs ui-widget ui-widget-content ui-corner-all elfinder-help">', '<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">'],
                m = '<div class="elfinder-help-shortcut"><div class="elfinder-help-shortcut-pattern">{pattern}</div> {descrip}</div>',
                g = '<div class="elfinder-help-separator"/>',
                v = function() {
                    f.push('<div id="about" class="ui-tabs-panel ui-widget-content ui-corner-bottom"><div class="elfinder-help-logo"/>'), f.push("<h3>elFinder</h3>"), f.push('<div class="' + c + '">' + t.i18n("webfm") + "</div>"), f.push('<div class="' + p + '">' + t.i18n("ver") + ": " + t.version + ", " + t.i18n("protocolver") + ': <span id="apiver"></span></div>'), f.push('<div class="' + p + '">jQuery/jQuery UI: ' + e().jquery + "/" + e.ui.version + "</div>"), f.push(g), f.push(i[d](a, "http://elfinder.org/")[d](o, t.i18n("homepage"))), f.push(i[d](a, "https://github.com/Studio-42/elFinder/wiki")[d](o, t.i18n("docs"))), f.push(i[d](a, "https://github.com/Studio-42/elFinder")[d](o, t.i18n("github"))), f.push(i[d](a, "http://twitter.com/elrte_elfinder")[d](o, t.i18n("twitter"))), f.push(g), f.push('<div class="' + c + '">' + t.i18n("team") + "</div>"), f.push(r[d](s, 'Dmitry "dio" Levashov &lt;dio@std42.ru&gt;')[d](l, t.i18n("chiefdev"))), f.push(r[d](s, "Troex Nevelin &lt;troex@fury.scancode.ru&gt;")[d](l, t.i18n("maintainer"))), f.push(r[d](s, "Alexey Sukhotin &lt;strogg@yandex.ru&gt;")[d](l, t.i18n("contributor"))), f.push(r[d](s, "Naoki Sawada &lt;hypweb@gmail.com&gt;")[d](l, t.i18n("contributor"))), t.i18[t.lang].translator && f.push(r[d](s, t.i18[t.lang].translator)[d](l, t.i18n("translator") + " (" + t.i18[t.lang].language + ")")), f.push(g), f.push('<div class="' + u + '">' + t.i18n("icons") + ': Pixelmixer, <a href="http://p.yusukekamiyamane.com" target="_blank">Fugue</a></div>'), f.push(g), f.push('<div class="' + u + '">Licence: BSD Licence</div>'), f.push('<div class="' + u + '">Copyright © 2009-2015, Studio 42</div>'), f.push('<div class="' + u + '">„ …' + t.i18n("dontforget") + " ”</div>"), f.push("</div>")
                },
                b = function() {
                    var n = t.shortcuts();
                    f.push('<div id="shortcuts" class="ui-tabs-panel ui-widget-content ui-corner-bottom">'), n.length ? (f.push('<div class="ui-widget-content elfinder-help-shortcuts">'), e.each(n, function(e, t) {
                        f.push(m.replace(/\{pattern\}/, t[0]).replace(/\{descrip\}/, t[1]))
                    }), f.push("</div>")) : f.push('<div class="elfinder-help-disabled">' + t.i18n("shortcutsof") + "</div>"), f.push("</div>")
                },
                y = function() {
                    f.push('<div id="help" class="ui-tabs-panel ui-widget-content ui-corner-bottom">'), f.push('<a href="http://elfinder.org/forum/" target="_blank" class="elfinder-dont-panic"><span>DON\'T PANIC</span></a>'), f.push("</div>")
                },
                w = "";
            this.alwaysEnabled = !0, this.updateOnSelect = !1, this.state = 0, this.shortcuts = [{
                pattern: "f1",
                description: this.title
            }], setTimeout(function() {
                var i = n.options.view || ["about", "shortcuts", "help"];
                e.each(i, function(e, n) {
                    f.push(h[d](/\{id\}/, n)[d](/\{title\}/, t.i18n(n)))
                }), f.push("</ul>"), -1 !== e.inArray("about", i) && v(), -1 !== e.inArray("shortcuts", i) && b(), -1 !== e.inArray("help", i) && y(), f.push("</div>"), w = e(f.join("")), w.find(".ui-tabs-nav li").hover(function() {
                    e(this).toggleClass("ui-state-hover")
                }).children().click(function(t) {
                    var n = e(this);
                    t.preventDefault(), t.stopPropagation(), n.is(".ui-tabs-selected") || (n.parent().addClass("ui-tabs-selected ui-state-active").siblings().removeClass("ui-tabs-selected").removeClass("ui-state-active"), w.find(".ui-tabs-panel").hide().filter(n.attr("href")).show())
                }).filter(":first").click()
            }, 200), this.getstate = function() {
                return 0
            }, this.exec = function() {
                this.dialog || (w.find("#apiver").text(this.fm.api), this.dialog = this.fm.dialog(w, {
                    title: this.title,
                    width: 530,
                    autoOpen: !1,
                    destroyOnClose: !1
                })), this.dialog.elfinderdialog("open").find(".ui-tabs-nav li a:first").click()
            }
        }, elFinder.prototype.commands.home = function() {
            this.title = "Home", this.alwaysEnabled = !0, this.updateOnSelect = !1, this.shortcuts = [{
                pattern: "ctrl+home ctrl+shift+up",
                description: "Home"
            }], this.getstate = function() {
                var e = this.fm.root(),
                    t = this.fm.cwd().hash;
                return e && t && e != t ? 0 : -1
            }, this.exec = function() {
                return this.fm.exec("open", this.fm.root())
            }
        }, elFinder.prototype.commands.info = function() {
            var t = this.fm,
                n = "elfinder-info-spinner",
                i = {
                    calc: t.i18n("calc"),
                    size: t.i18n("size"),
                    unknown: t.i18n("unknown"),
                    path: t.i18n("path"),
                    aliasfor: t.i18n("aliasfor"),
                    modify: t.i18n("modify"),
                    perms: t.i18n("perms"),
                    locked: t.i18n("locked"),
                    dim: t.i18n("dim"),
                    kind: t.i18n("kind"),
                    files: t.i18n("files"),
                    folders: t.i18n("folders"),
                    items: t.i18n("items"),
                    yes: t.i18n("yes"),
                    no: t.i18n("no"),
                    link: t.i18n("link")
                };
            this.tpl = {
                main: '<div class="ui-helper-clearfix elfinder-info-title"><span class="elfinder-cwd-icon {class} ui-corner-all"/>{title}</div><table class="elfinder-info-tb">{content}</table>',
                itemTitle: '<strong>{name}</strong><span class="elfinder-info-kind">{kind}</span>',
                groupTitle: "<strong>{items}: {num}</strong>",
                row: "<tr><td>{label} : </td><td>{value}</td></tr>",
                spinner: '<span>{text}</span> <span class="' + n + '"/>'
            }, this.alwaysEnabled = !0, this.updateOnSelect = !1, this.shortcuts = [{
                pattern: "ctrl+i"
            }], this.init = function() {
                e.each(i, function(e, n) {
                    i[e] = t.i18n(n)
                })
            }, this.getstate = function() {
                return 0
            }, this.exec = function(t) {
                var r = this.files(t);
                r.length || (r = this.files([this.fm.cwd().hash]));
                var a, o, s, l, d, c = this.fm,
                    p = this.options,
                    u = this.tpl,
                    h = u.row,
                    f = r.length,
                    m = [],
                    g = u.main,
                    v = "{label}",
                    b = "{value}",
                    y = {
                        title: this.title,
                        width: "auto",
                        close: function() {
                            e(this).elfinderdialog("destroy")
                        }
                    },
                    w = [],
                    x = function(e) {
                        C.find("." + n).parent().text(e)
                    },
                    k = c.namespace + "-info-" + e.map(r, function(e) {
                        return e.hash
                    }).join("-"),
                    C = c.getUI().find("#" + k);
                if (!f) return e.Deferred().reject();
                if (C.length) return C.elfinderdialog("toTop"), e.Deferred().resolve();
                if (1 == f) {
                    if (s = r[0], g = g.replace("{class}", c.mime2class(s.mime)), l = u.itemTitle.replace("{name}", c.escape(s.i18 || s.name)).replace("{kind}", c.mime2kind(s)), s.tmb && (o = c.option("tmbUrl") + s.tmb), s.read ? "directory" != s.mime || s.alias ? a = c.formatSize(s.size) : (a = u.spinner.replace("{text}", i.calc), w.push(s.hash)) : a = i.unknown, m.push(h.replace(v, i.size).replace(b, a)), s.alias && m.push(h.replace(v, i.aliasfor).replace(b, s.alias)), m.push(h.replace(v, i.path).replace(b, c.escape(c.path(s.hash, !0)))), s.read) {
                        var T;
                        if (p.nullUrlDirLinkSelf && "directory" == s.mime && null === s.url) {
                            var I = window.location;
                            T = I.pathname + I.search + "#elf_" + s.hash
                        } else T = c.url(s.hash);
                        m.push(h.replace(v, i.link).replace(b, '<a href="' + T + '" target="_blank">' + c.escape(s.name) + "</a>"))
                    }
                    s.dim ? m.push(h.replace(v, i.dim).replace(b, s.dim)) : -1 !== s.mime.indexOf("image") && (s.width && s.height ? m.push(h.replace(v, i.dim).replace(b, s.width + "x" + s.height)) : (m.push(h.replace(v, i.dim).replace(b, u.spinner.replace("{text}", i.calc))), c.request({
                        data: {
                            cmd: "dim",
                            target: s.hash
                        },
                        preventDefault: !0
                    }).fail(function() {
                        x(i.unknown)
                    }).done(function(e) {
                        if (x(e.dim || i.unknown), e.dim) {
                            var t = e.dim.split("x"),
                                n = c.file(s.hash);
                            n.width = t[0], n.height = t[1]
                        }
                    }))), m.push(h.replace(v, i.modify).replace(b, c.formatDate(s))), m.push(h.replace(v, i.perms).replace(b, c.formatPermissions(s))), m.push(h.replace(v, i.locked).replace(b, s.locked ? i.yes : i.no))
                } else g = g.replace("{class}", "elfinder-cwd-icon-group"), l = u.groupTitle.replace("{items}", i.items).replace("{num}", f), d = e.map(r, function(e) {
                    return "directory" == e.mime ? 1 : null
                }).length, d ? (m.push(h.replace(v, i.kind).replace(b, d == f ? i.folders : i.folders + " " + d + ", " + i.files + " " + (f - d))), m.push(h.replace(v, i.size).replace(b, u.spinner.replace("{text}", i.calc))), w = e.map(r, function(e) {
                    return e.hash
                })) : (a = 0, e.each(r, function(e, t) {
                    var n = parseInt(t.size);
                    n >= 0 && a >= 0 ? a += n : a = "unknown"
                }), m.push(h.replace(v, i.kind).replace(b, i.files)), m.push(h.replace(v, i.size).replace(b, c.formatSize(a))));
                g = g.replace("{title}", l).replace("{content}", m.join("")), C = c.dialog(g, y), C.attr("id", k), o && e("<img/>").load(function() {
                    C.find(".elfinder-cwd-icon").css("background", 'url("' + o + '") center center no-repeat')
                }).attr("src", o), w.length && c.request({
                    data: {
                        cmd: "size",
                        targets: w
                    },
                    preventDefault: !0
                }).fail(function() {
                    x(i.unknown)
                }).done(function(e) {
                    var t = parseInt(e.size);
                    x(t >= 0 ? c.formatSize(t) : i.unknown)
                })
            }
        }, elFinder.prototype.commands.mkdir = function() {
            this.disableOnSearch = !0, this.updateOnSelect = !1, this.mime = "directory", this.prefix = "untitled folder", this.exec = e.proxy(this.fm.res("mixin", "make"), this), this.shortcuts = [{
                pattern: "ctrl+shift+n"
            }], this.getstate = function() {
                return !this._disabled && this.fm.cwd().write ? 0 : -1
            }
        }, elFinder.prototype.commands.mkfile = function() {
            this.disableOnSearch = !0, this.updateOnSelect = !1, this.mime = "text/plain", this.prefix = "untitled file.txt", this.exec = e.proxy(this.fm.res("mixin", "make"), this), this.getstate = function() {
                return !this._disabled && this.fm.cwd().write ? 0 : -1
            }
        }, elFinder.prototype.commands.netmount = function() {
            var t = this;
            this.alwaysEnabled = !0, this.updateOnSelect = !1, this.drivers = [], this.handlers = {
                load: function() {
                    this.drivers = this.fm.netDrivers
                }
            }, this.getstate = function() {
                return this.drivers.length ? 0 : -1
            }, this.exec = function() {
                var n = t.fm,
                    i = e.Deferred(),
                    r = function() {
                        var r = {
                                protocol: e("<select/>"),
                                host: e('<input type="text"/>'),
                                port: e('<input type="text"/>'),
                                path: e('<input type="text" value="/"/>'),
                                user: e('<input type="text"/>'),
                                pass: e('<input type="password"/>')
                            },
                            a = {
                                title: n.i18n("netMountDialogTitle"),
                                resizable: !1,
                                modal: !0,
                                destroyOnClose: !0,
                                close: function() {
                                    delete t.dialog, "pending" == i.state() && i.reject()
                                },
                                buttons: {}
                            },
                            o = e('<table class="elfinder-info-tb elfinder-netmount-tb"/>');
                        return e.each(t.drivers, function(e, t) {
                            r.protocol.append('<option value="' + t + '">' + n.i18n(t) + "</option>")
                        }), e.each(r, function(t, i) {
                            "protocol" != t && i.addClass("ui-corner-all"), o.append(e("<tr/>").append(e("<td>" + n.i18n(t) + "</td>")).append(e("<td/>").append(i)))
                        }), a.buttons[n.i18n("btnMount")] = function() {
                            var n = {
                                cmd: "netmount"
                            };
                            return e.each(r, function(t, i) {
                                var r = e.trim(i.val());
                                r && (n[t] = r)
                            }), n.host ? (t.fm.request({
                                data: n,
                                notify: {
                                    type: "netmount",
                                    cnt: 1
                                }
                            }).done(function() {
                                i.resolve()
                            }).fail(function(e) {
                                i.reject(e)
                            }), t.dialog.elfinderdialog("close"), void 0) : t.fm.trigger("error", {
                                error: "errNetMountHostReq"
                            })
                        }, a.buttons[n.i18n("btnCancel")] = function() {
                            t.dialog.elfinderdialog("close")
                        }, n.dialog(o, a)
                    };
                return t.dialog || (t.dialog = r()), i.promise()
            }
        }, elFinder.prototype.commands.open = function() {
            this.alwaysEnabled = !0, this._handlers = {
                dblclick: function(e) {
                    e.preventDefault(), this.exec()
                },
                "select enable disable reload": function(e) {
                    this.update("disable" == e.type ? -1 : void 0)
                }
            }, this.shortcuts = [{
                pattern: "ctrl+down numpad_enter" + ("mac" != this.fm.OS && " enter")
            }], this.getstate = function(t) {
                var t = this.files(t),
                    n = t.length;
                return 1 == n ? 0 : n ? e.map(t, function(e) {
                    return "directory" == e.mime ? null : e
                }).length == n ? 0 : -1 : -1
            }, this.exec = function(t) {
                var n, i, r, a, o = this.fm,
                    s = e.Deferred().fail(function(e) {
                        e && o.error(e)
                    }),
                    l = this.files(t),
                    d = l.length;
                if (!d) return s.reject();
                if (1 == d && (n = l[0]) && "directory" == n.mime) return n && !n.read ? s.reject(["errOpen", n.name, "errPerm"]) : o.request({
                    data: {
                        cmd: "open",
                        target: n.thash || n.hash
                    },
                    notify: {
                        type: "open",
                        cnt: 1,
                        hideCnt: !0
                    },
                    syncOnFail: !0
                });
                if (l = e.map(l, function(e) {
                        return "directory" != e.mime ? e : null
                    }), d != l.length) return s.reject();
                for (d = l.length; d--;) {
                    if (n = l[d], !n.read) return s.reject(["errOpen", n.name, "errPerm"]);
                    (i = o.url(n.hash)) || (i = o.options.url, i = i + (-1 === i.indexOf("?") ? "?" : "&") + (o.oldAPI ? "cmd=open&current=" + n.phash : "cmd=file") + "&target=" + n.hash), n.dim ? (r = n.dim.split("x"), a = "width=" + (parseInt(r[0]) + 20) + ",height=" + (parseInt(r[1]) + 20)) : a = "width=" + parseInt(2 * e(window).width() / 3) + ",height=" + parseInt(2 * e(window).height() / 3);
                    var c = window.open("", "new_window", a + ",top=50,left=50,scrollbars=yes,resizable=yes");
                    if (!c) return s.reject("errPopup");
                    var p = document.createElement("form");
                    p.action = o.options.url, p.method = "POST", p.target = "new_window", p.style.display = "none";
                    var u = e.extend({}, o.options.customData, {
                        cmd: "file",
                        target: n.hash
                    });
                    e.each(u, function(e, t) {
                        var n = document.createElement("input");
                        n.name = e, n.value = t, p.appendChild(n)
                    }), document.body.appendChild(p), p.submit()
                }
                return s.resolve(t)
            }
        }, elFinder.prototype.commands.paste = function() {
            this.updateOnSelect = !1, this.handlers = {
                changeclipboard: function() {
                    this.update()
                }
            }, this.shortcuts = [{
                pattern: "ctrl+v shift+insert"
            }], this.getstate = function(t) {
                if (this._disabled) return -1;
                if (t) {
                    if (e.isArray(t)) {
                        if (1 != t.length) return -1;
                        t = this.fm.file(t[0])
                    }
                } else t = this.fm.cwd();
                return this.fm.clipboard().length && "directory" == t.mime && t.write ? 0 : -1
            }, this.exec = function(t) {
                var n, i, r = this,
                    a = r.fm,
                    t = t ? this.files(t)[0] : a.cwd(),
                    o = a.clipboard(),
                    s = o.length,
                    l = s ? o[0].cut : !1,
                    d = l ? "errMove" : "errCopy",
                    c = [],
                    p = [],
                    u = e.Deferred().fail(function(e) {
                        e && a.error(e)
                    }),
                    h = function(t) {
                        return t.length && a._commands.duplicate ? a.exec("duplicate", t) : e.Deferred().resolve()
                    },
                    f = function(n) {
                        var i = e.Deferred(),
                            o = [],
                            s = function(t, n) {
                                for (var i = [], r = t.length; r--;) - 1 !== e.inArray(t[r].name, n) && i.unshift(r);
                                return i
                            },
                            d = function(e) {
                                var t = o[e],
                                    r = n[t],
                                    s = e == o.length - 1;
                                r && a.confirm({
                                    title: a.i18n(l ? "moveFiles" : "copyFiles"),
                                    text: ["errExists", r.name, "confirmRepl"],
                                    all: !s,
                                    accept: {
                                        label: "btnYes",
                                        callback: function(t) {
                                            s || t ? p(n) : d(++e)
                                        }
                                    },
                                    reject: {
                                        label: "btnNo",
                                        callback: function(t) {
                                            var i;
                                            if (t)
                                                for (i = o.length; e < i--;) n[o[i]].remove = !0;
                                            else n[o[e]].remove = !0;
                                            s || t ? p(n) : d(++e)
                                        }
                                    },
                                    cancel: {
                                        label: "btnCancel",
                                        callback: function() {
                                            i.resolve()
                                        }
                                    }
                                })
                            },
                            c = function(e) {
                                o = s(n, e), o.length ? d(0) : p(n)
                            },
                            p = function(n) {
                                var r, n = e.map(n, function(e) {
                                        return e.remove ? null : e
                                    }),
                                    o = n.length;
                                return o ? (r = n[0].phash, n = e.map(n, function(e) {
                                    return e.hash
                                }), a.request({
                                    data: {
                                        cmd: "paste",
                                        dst: t.hash,
                                        targets: n,
                                        cut: l ? 1 : 0,
                                        src: r
                                    },
                                    notify: {
                                        type: l ? "move" : "copy",
                                        cnt: o
                                    }
                                }).always(function() {
                                    i.resolve(), a.unlockfiles({
                                        files: n
                                    })
                                }), void 0) : i.resolve()
                            };
                        return r._disabled || !n.length ? i.resolve() : (a.oldAPI ? p(n) : a.option("copyOverwrite") ? t.hash == a.cwd().hash ? c(e.map(a.files(), function(e) {
                            return e.phash == t.hash ? e.name : null
                        })) : a.request({
                            data: {
                                cmd: "ls",
                                target: t.hash
                            },
                            notify: {
                                type: "prepare",
                                cnt: 1,
                                hideCnt: !0
                            },
                            preventFail: !0
                        }).always(function(e) {
                            c(e.list || [])
                        }) : p(n), i)
                    };
                return s && t && "directory" == t.mime ? t.write ? (n = a.parents(t.hash), e.each(o, function(r, s) {
                    return s.read ? l && s.locked ? !u.reject(["errLocked", s.name]) : -1 !== e.inArray(s.hash, n) ? !u.reject(["errCopyInItself", s.name]) : (i = a.parents(s.hash), i.pop(), -1 !== e.inArray(t.hash, i) && e.map(i, function(e) {
                        var n = a.file(e);
                        return n.phash == t.hash && n.name == s.name ? n : null
                    }).length ? !u.reject(["errReplByChild", s.name]) : (s.phash == t.hash ? p.push(s.hash) : c.push({
                        hash: s.hash,
                        phash: s.phash,
                        name: s.name
                    }), void 0)) : !u.reject([d, o[0].name, "errPerm"])
                }), "rejected" == u.state() ? u : e.when(h(p), f(c)).always(function() {
                    l && a.clipboard([])
                })) : u.reject([d, o[0].name, "errPerm"]) : u.reject()
            }
        }, elFinder.prototype.commands.quicklook = function() {
            var t, n, i, r, a = this,
                o = a.fm,
                s = 0,
                l = 1,
                d = 2,
                c = s,
                p = "elfinder-quicklook-navbar-icon",
                u = "elfinder-quicklook-fullscreen",
                h = function(t) {
                    e(document).trigger(e.Event("keydown", {
                        keyCode: t,
                        ctrlKey: !1,
                        shiftKey: !1,
                        altKey: !1,
                        metaKey: !1
                    }))
                },
                f = function(e) {
                    return {
                        opacity: 0,
                        width: 20,
                        height: "list" == o.view ? 1 : 20,
                        top: e.offset().top + "px",
                        left: e.offset().left + "px"
                    }
                },
                m = function() {
                    var i = e(window);
                    return {
                        opacity: 1,
                        width: t,
                        height: n,
                        top: parseInt((i.height() - n) / 2 + i.scrollTop()),
                        left: parseInt((i.width() - t) / 2 + i.scrollLeft())
                    }
                },
                g = function(e) {
                    var t = document.createElement(e.substr(0, e.indexOf("/"))),
                        n = !1;
                    try {
                        n = t.canPlayType && t.canPlayType(e)
                    } catch (i) {}
                    return n && "" !== n && "no" != n
                },
                v = e('<div class="elfinder-quicklook-title"/>'),
                b = e("<div/>"),
                y = e('<div class="elfinder-quicklook-info"/>'),
                w = e('<div class="' + p + " " + p + '-fullscreen"/>').mousedown(function(t) {
                    var n = a.window,
                        r = n.is("." + u),
                        s = "scroll." + o.namespace,
                        l = e(window);
                    t.stopPropagation(), r ? (n.css(n.data("position")).unbind("mousemove"), l.unbind(s).trigger(a.resize).unbind(a.resize), x.unbind("mouseenter").unbind("mousemove")) : (n.data("position", {
                        left: n.css("left"),
                        top: n.css("top"),
                        width: n.width(),
                        height: n.height()
                    }).css({
                        width: "100%",
                        height: "100%"
                    }), e(window).bind(s, function() {
                        n.css({
                            left: parseInt(e(window).scrollLeft()) + "px",
                            top: parseInt(e(window).scrollTop()) + "px"
                        })
                    }).bind(a.resize, function() {
                        a.preview.trigger("changesize")
                    }).trigger(s).trigger(a.resize), n.bind("mousemove", function() {
                        x.stop(!0, !0).show().delay(3e3).fadeOut("slow")
                    }).mousemove(), x.mouseenter(function() {
                        x.stop(!0, !0).show()
                    }).mousemove(function(e) {
                        e.stopPropagation()
                    })), x.attr("style", "").draggable(r ? "destroy" : {}), n.toggleClass(u), e(this).toggleClass(p + "-fullscreen-off");
                    var d = n;
                    i.is(".ui-resizable") && (d = d.add(i)), e.fn.resizable && d.resizable(r ? "enable" : "disable").removeClass("ui-state-disabled")
                }),
                x = e('<div class="elfinder-quicklook-navbar"/>').append(e('<div class="' + p + " " + p + '-prev"/>').mousedown(function() {
                    h(37)
                })).append(w).append(e('<div class="' + p + " " + p + '-next"/>').mousedown(function() {
                    h(39)
                })).append('<div class="elfinder-quicklook-navbar-separator"/>').append(e('<div class="' + p + " " + p + '-close"/>').mousedown(function() {
                    a.window.trigger("close")
                }));
            this.resize = "resize." + o.namespace, this.info = e('<div class="elfinder-quicklook-info-wrapper"/>').append(b).append(y), this.preview = e('<div class="elfinder-quicklook-preview ui-helper-clearfix"/>').bind("change", function() {
                a.info.attr("style", "").hide(), b.removeAttr("class").attr("style", ""), y.html("")
            }).bind("update", function(t) {
                var n, i = a.fm,
                    r = (a.preview, t.file),
                    o = '<div class="elfinder-quicklook-info-data">{value}</div>';
                r ? (!r.read && t.stopImmediatePropagation(), a.window.data("hash", r.hash), a.preview.unbind("changesize").trigger("change").children().remove(), v.html(i.escape(r.name)), y.html(o.replace(/\{value\}/, i.escape(r.name)) + o.replace(/\{value\}/, i.mime2kind(r)) + ("directory" == r.mime ? "" : o.replace(/\{value\}/, i.formatSize(r.size))) + o.replace(/\{value\}/, i.i18n("modify") + ": " + i.formatDate(r))), b.addClass("elfinder-cwd-icon ui-corner-all " + i.mime2class(r.mime)), r.tmb && e("<img/>").hide().appendTo(a.preview).load(function() {
                    b.css("background", 'url("' + n + '") center center no-repeat'), e(this).remove()
                }).attr("src", n = i.tmb(r.hash)), a.info.delay(100).fadeIn(10)) : t.stopImmediatePropagation()
            }), this.window = e('<div class="ui-helper-reset ui-widget elfinder-quicklook" style="position:absolute"/>').click(function(e) {
                e.stopPropagation()
            }).append(e('<div class="elfinder-quicklook-titlebar"/>').append(v).append(e('<span class="ui-icon ui-icon-circle-close"/>').mousedown(function(e) {
                e.stopPropagation(), a.window.trigger("close")
            }))).append(this.preview.add(x)).append(a.info.hide()).draggable({
                handle: "div.elfinder-quicklook-titlebar"
            }).bind("open", function() {
                var e, t = a.window,
                    n = a.value;
                a.closed() && n && (e = r.find("#" + n.hash)).length && (x.attr("style", ""), c = l, e.trigger("scrolltoview"), t.css(f(e)).show().animate(m(), 550, function() {
                    c = d, a.update(1, a.value)
                }))
            }).bind("close", function() {
                var e = a.window,
                    t = a.preview.trigger("change"),
                    n = (a.value, r.find("#" + e.data("hash"))),
                    i = function() {
                        c = s, e.hide(), t.children().remove(), a.update(0, a.value)
                    };
                a.opened() && (c = l, e.is("." + u) && w.mousedown(), n.length ? e.animate(f(n), 500, i) : i())
            }), this.alwaysEnabled = !0, this.value = null, this.handlers = {
                select: function() {
                    this.update(void 0, this.fm.selectedFiles()[0])
                },
                error: function() {
                    a.window.is(":visible") && a.window.data("hash", "").trigger("close")
                },
                "searchshow searchhide": function() {
                    this.opened() && this.window.trigger("close")
                }
            }, this.shortcuts = [{
                pattern: "space"
            }], this.support = {
                audio: {
                    ogg: g('audio/ogg; codecs="vorbis"'),
                    mp3: g("audio/mpeg;"),
                    wav: g('audio/wav; codecs="1"'),
                    m4a: g("audio/x-m4a;") || g("audio/aac;")
                },
                video: {
                    ogg: g('video/ogg; codecs="theora"'),
                    webm: g('video/webm; codecs="vp8, vorbis"'),
                    mp4: g('video/mp4; codecs="avc1.42E01E"') || g('video/mp4; codecs="avc1.42E01E, mp4a.40.2"')
                }
            }, this.closed = function() {
                return c == s
            }, this.opened = function() {
                return c == d
            }, this.init = function() {
                var s = this.options,
                    l = this.window,
                    d = this.preview;
                t = s.width > 0 ? parseInt(s.width) : 450, n = s.height > 0 ? parseInt(s.height) : 300, o.one("load", function() {
                    i = o.getUI(), r = o.getUI("cwd"), l.appendTo("body").zIndex(100 + i.zIndex()), e(document).keydown(function(e) {
                        27 == e.keyCode && a.opened() && l.trigger("close")
                    }), e.fn.resizable && l.resizable({
                        handles: "se",
                        minWidth: 350,
                        minHeight: 120,
                        resize: function() {
                            d.trigger("changesize")
                        }
                    }), a.change(function() {
                        a.opened() && (a.value ? d.trigger(e.Event("update", {
                            file: a.value
                        })) : l.trigger("close"))
                    }), e.each(o.commands.quicklook.plugins || [], function(e, t) {
                        "function" == typeof t && new t(a)
                    }), d.bind("update", function() {
                        a.info.show()
                    })
                })
            }, this.getstate = function() {
                return 1 == this.fm.selected().length ? c == d ? 1 : 0 : -1
            }, this.exec = function() {
                this.enabled() && this.window.trigger(this.opened() ? "close" : "open")
            }, this.hideinfo = function() {
                this.info.stop(!0).hide()
            }
        }, elFinder.prototype.commands.quicklook.plugins = [function(t) {
            var n = ["image/jpeg", "image/png", "image/gif"],
                i = t.preview;
            e.each(navigator.mimeTypes, function(t, i) {
                var r = i.type;
                0 === r.indexOf("image/") && e.inArray(r, n) && n.push(r)
            }), i.bind("update", function(r) {
                var a, o = r.file; - 1 !== e.inArray(o.mime, n) && (r.stopImmediatePropagation(), a = e("<img/>").hide().appendTo(i).load(function() {
                    setTimeout(function() {
                        var e = (a.width() / a.height()).toFixed(2);
                        i.bind("changesize", function() {
                            var t, n, r = parseInt(i.width()),
                                o = parseInt(i.height());
                            e < (r / o).toFixed(2) ? (n = o, t = Math.floor(n * e)) : (t = r, n = Math.floor(t / e)), a.width(t).height(n).css("margin-top", o > n ? Math.floor((o - n) / 2) : 0)
                        }).trigger("changesize"), t.hideinfo(), a.fadeIn(100)
                    }, 1)
                }).attr("src", t.fm.url(o.hash)))
            })
        }, function(t) {
            var n = ["text/html", "application/xhtml+xml"],
                i = t.preview,
                r = t.fm;
            i.bind("update", function(a) {
                var o, s = a.file; - 1 !== e.inArray(s.mime, n) && (a.stopImmediatePropagation(), i.one("change", function() {
                    "pending" == o.state() && o.reject()
                }), o = r.request({
                    data: {
                        cmd: "get",
                        target: s.hash,
                        current: s.phash
                    },
                    preventDefault: !0
                }).done(function(n) {
                    t.hideinfo(), doc = e('<iframe class="elfinder-quicklook-preview-html"/>').appendTo(i)[0].contentWindow.document, doc.open(), doc.write(n.content), doc.close()
                }))
            })
        }, function(t) {
            var n = t.fm,
                i = n.res("mimes", "text"),
                r = t.preview;
            r.bind("update", function(a) {
                var o, s = a.file,
                    l = s.mime;
                (0 === l.indexOf("text/") || -1 !== e.inArray(l, i)) && (a.stopImmediatePropagation(), r.one("change", function() {
                    "pending" == o.state() && o.reject()
                }), o = n.request({
                    data: {
                        cmd: "get",
                        target: s.hash
                    },
                    preventDefault: !0
                }).done(function(i) {
                    t.hideinfo(), e('<div class="elfinder-quicklook-preview-text-wrapper"><pre class="elfinder-quicklook-preview-text">' + n.escape(i.content) + "</pre></div>").appendTo(r)
                }))
            })
        }, function(t) {
            var n = t.fm,
                i = "application/pdf",
                r = t.preview,
                a = !1;
            n.UA.Safari && "mac" == n.OS || n.UA.IE ? a = !0 : e.each(navigator.plugins, function(t, n) {
                e.each(n, function(e, t) {
                    return t.type == i ? !(a = !0) : void 0
                })
            }), a && r.bind("update", function(a) {
                var o, s = a.file;
                s.mime == i && (a.stopImmediatePropagation(), r.one("change", function() {
                    o.unbind("load").remove()
                }), o = e('<iframe class="elfinder-quicklook-preview-pdf"/>').hide().appendTo(r).load(function() {
                    t.hideinfo(), o.show()
                }).attr("src", n.url(s.hash)))
            })
        }, function(t) {
            var n = t.fm,
                i = "application/x-shockwave-flash",
                r = t.preview,
                a = !1;
            e.each(navigator.plugins, function(t, n) {
                e.each(n, function(e, t) {
                    return t.type == i ? !(a = !0) : void 0
                })
            }), a && r.bind("update", function(a) {
                var o, s = a.file;
                s.mime == i && (a.stopImmediatePropagation(), t.hideinfo(), r.append(o = e('<embed class="elfinder-quicklook-preview-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="' + n.url(s.hash) + '" quality="high" type="application/x-shockwave-flash" />')))
            })
        }, function(t) {
            var n, i = t.preview,
                r = !!t.options.autoplay,
                a = {
                    "audio/mpeg": "mp3",
                    "audio/mpeg3": "mp3",
                    "audio/mp3": "mp3",
                    "audio/x-mpeg3": "mp3",
                    "audio/x-mp3": "mp3",
                    "audio/x-wav": "wav",
                    "audio/wav": "wav",
                    "audio/x-m4a": "m4a",
                    "audio/aac": "m4a",
                    "audio/mp4": "m4a",
                    "audio/x-mp4": "m4a",
                    "audio/ogg": "ogg"
                };
            i.bind("update", function(o) {
                var s = o.file,
                    l = a[s.mime];
                t.support.audio[l] && (o.stopImmediatePropagation(), n = e('<audio class="elfinder-quicklook-preview-audio" controls preload="auto" autobuffer><source src="' + t.fm.url(s.hash) + '" /></audio>').appendTo(i), r && n[0].play())
            }).bind("change", function() {
                n && n.parent().length && (n[0].pause(), n.remove(), n = null)
            })
        }, function(t) {
            var n, i = t.preview,
                r = !!t.options.autoplay,
                a = {
                    "video/mp4": "mp4",
                    "video/x-m4v": "mp4",
                    "video/ogg": "ogg",
                    "application/ogg": "ogg",
                    "video/webm": "webm"
                };
            i.bind("update", function(o) {
                var s = o.file,
                    l = a[s.mime];
                t.support.video[l] && (o.stopImmediatePropagation(), t.hideinfo(), n = e('<video class="elfinder-quicklook-preview-video" controls preload="auto" autobuffer><source src="' + t.fm.url(s.hash) + '" /></video>').appendTo(i), r && n[0].play())
            }).bind("change", function() {
                n && n.parent().length && (n[0].pause(), n.remove(), n = null)
            })
        }, function(t) {
            var n, i = t.preview,
                r = [];
            e.each(navigator.plugins, function(t, n) {
                e.each(n, function(e, t) {
                    (0 === t.type.indexOf("audio/") || 0 === t.type.indexOf("video/")) && r.push(t.type)
                })
            }), i.bind("update", function(a) {
                var o, s = a.file,
                    l = s.mime; - 1 !== e.inArray(s.mime, r) && (a.stopImmediatePropagation(), (o = 0 === l.indexOf("video/")) && t.hideinfo(), n = e('<embed src="' + t.fm.url(s.hash) + '" type="' + l + '" class="elfinder-quicklook-preview-' + (o ? "video" : "audio") + '"/>').appendTo(i))
            }).bind("change", function() {
                n && n.parent().length && (n.remove(), n = null)
            })
        }], elFinder.prototype.commands.reload = function() {
            var t = !1;
            this.alwaysEnabled = !0, this.updateOnSelect = !0, this.shortcuts = [{
                pattern: "ctrl+shift+r f5"
            }], this.getstate = function() {
                return 0
            }, this.init = function() {
                this.fm.bind("search searchend", function(e) {
                    t = "search" == e.type
                })
            }, this.exec = function() {
                var n = this.fm;
                if (!t) {
                    var i = n.sync(),
                        r = setTimeout(function() {
                            n.notify({
                                type: "reload",
                                cnt: 1,
                                hideCnt: !0
                            }), i.always(function() {
                                n.notify({
                                    type: "reload",
                                    cnt: -1
                                })
                            })
                        }, n.notifyDelay);
                    return i.always(function() {
                        clearTimeout(r), n.trigger("reload")
                    })
                }
                e("div.elfinder-toolbar > div." + n.res("class", "searchbtn") + " > span.ui-icon-search").click()
            }
        }, elFinder.prototype.commands.rename = function() {
            this.shortcuts = [{
                pattern: "f2" + ("mac" == this.fm.OS ? " enter" : "")
            }], this.getstate = function() {
                var e = this.fm.selectedFiles();
                return this._disabled || 1 != e.length || !e[0].phash || e[0].locked ? -1 : 0
            }, this.exec = function() {
                var t = this.fm,
                    n = t.getUI("cwd"),
                    i = t.selected(),
                    r = i.length,
                    a = t.file(i.shift()),
                    o = ".elfinder-cwd-filename",
                    s = e.Deferred().fail(function(e) {
                        var i = l.parent(),
                            r = t.escape(a.name);
                        i.length ? (l.remove(), i.html(r)) : (n.find("#" + a.hash).find(o).html(r), setTimeout(function() {
                            n.find("#" + a.hash).click()
                        }, 50)), e && t.error(e)
                    }).always(function() {
                        t.enable()
                    }),
                    l = e('<input type="text"/>').keydown(function(t) {
                        t.stopPropagation(), t.stopImmediatePropagation(), t.keyCode == e.ui.keyCode.ESCAPE ? s.reject() : t.keyCode == e.ui.keyCode.ENTER && l.blur()
                    }).mousedown(function(e) {
                        e.stopPropagation()
                    }).click(function(e) {
                        e.stopPropagation()
                    }).dblclick(function(e) {
                        e.stopPropagation(), e.preventDefault()
                    }).blur(function() {
                        var n = e.trim(l.val()),
                            i = l.parent();
                        if (i.length) {
                            if (l[0].setSelectionRange && l[0].setSelectionRange(0, 0), n == a.name) return s.reject();
                            if (!n) return s.reject("errInvName");
                            if (t.fileByName(n, a.phash)) return s.reject(["errExists", n]);
                            i.html(t.escape(n)), t.lockfiles({
                                files: [a.hash]
                            }), t.request({
                                data: {
                                    cmd: "rename",
                                    target: a.hash,
                                    name: n
                                },
                                notify: {
                                    type: "rename",
                                    cnt: 1
                                }
                            }).fail(function() {
                                s.reject(), t.sync()
                            }).done(function(e) {
                                s.resolve(e)
                            }).always(function() {
                                t.unlockfiles({
                                    files: [a.hash]
                                })
                            })
                        }
                    }),
                    d = n.find("#" + a.hash).find(o).empty().append(l.val(a.name)),
                    c = l.val().replace(/\.((tar\.(gz|bz|bz2|z|lzo))|cpio\.gz|ps\.gz|xcf\.(gz|bz2)|[a-z0-9]{1,4})$/gi, "");
                return this.disabled() ? s.reject() : !a || r > 1 || !d.length ? s.reject("errCmdParams", this.title) : a.locked ? s.reject(["errLocked", a.name]) : (t.one("select", function() {
                    l.parent().length && a && -1 === e.inArray(a.hash, t.selected()) && l.blur()
                }), l.select().focus(), l[0].setSelectionRange && l[0].setSelectionRange(0, c.length), s)
            }
        }, elFinder.prototype.commands.resize = function() {
            this.updateOnSelect = !1, this.getstate = function() {
                var e = this.fm.selectedFiles();
                return !this._disabled && 1 == e.length && e[0].read && e[0].write && -1 !== e[0].mime.indexOf("image/") ? 0 : -1
            }, this.exec = function(t) {
                var n, i, r = this.fm,
                    a = this.files(t),
                    o = e.Deferred(),
                    s = function(t, n) {
                        var i = e('<div class="elfinder-dialog-resize"/>'),
                            a = '<input type="text" size="5"/>',
                            s = '<div class="elfinder-resize-row"/>',
                            l = '<div class="elfinder-resize-label"/>',
                            d = e('<div class="elfinder-resize-control"/>'),
                            c = e('<div class="elfinder-resize-preview"/>'),
                            p = e('<div class="elfinder-resize-spinner">' + r.i18n("ntfloadimg") + "</div>"),
                            u = e('<div class="elfinder-resize-handle"/>'),
                            h = e('<div class="elfinder-resize-handle"/>'),
                            f = e('<div class="elfinder-resize-uiresize"/>'),
                            m = e('<div class="elfinder-resize-uicrop"/>'),
                            g = '<div class="ui-widget-content ui-corner-all elfinder-buttonset"/>',
                            v = '<div class="ui-state-default elfinder-button"/>',
                            b = '<span class="ui-widget-content elfinder-toolbar-button-separator"/>',
                            y = e('<div class="elfinder-resize-rotate"/>'),
                            w = e(v).attr("title", r.i18n("rotate-cw")).append(e('<span class="elfinder-button-icon elfinder-button-icon-rotate-l"/>').click(function() {
                                V -= 90, Q.update(V)
                            })),
                            x = e(v).attr("title", r.i18n("rotate-ccw")).append(e('<span class="elfinder-button-icon elfinder-button-icon-rotate-r"/>').click(function() {
                                V += 90, Q.update(V)
                            })),
                            k = e("<span />"),
                            C = e('<div class="ui-state-default ui-corner-all elfinder-resize-reset"><span class="ui-icon ui-icon-arrowreturnthick-1-w"/></div>'),
                            T = e('<div class="elfinder-resize-type"/>').append('<input type="radio" name="type" id="' + n + '-resize" value="resize" checked="checked" /><label for="' + n + '-resize">' + r.i18n("resize") + "</label>").append('<input type="radio" name="type" id="' + n + '-crop" value="crop" /><label for="' + n + '-crop">' + r.i18n("crop") + "</label>").append('<input type="radio" name="type" id="' + n + '-rotate" value="rotate" /><label for="' + n + '-rotate">' + r.i18n("rotate") + "</label>"),
                            I = e("input", T).attr("disabled", "disabled").change(function() {
                                var t = e("input:checked", T).val();
                                X(), et(!0), tt(!0), nt(!0), "resize" == t ? (f.show(), y.hide(), m.hide(), et()) : "crop" == t ? (y.hide(), f.hide(), m.show(), tt()) : "rotate" == t && (f.hide(), m.hide(), y.show(), nt())
                            }),
                            F = e('<input type="checkbox" checked="checked"/>').change(function() {
                                H = !!F.prop("checked"), Y.fixHeight(), et(!0), et()
                            }),
                            P = e(a).change(function() {
                                var e = parseInt(P.val()),
                                    t = parseInt(H ? Math.round(e / U) : z.val());
                                e > 0 && t > 0 && (Y.updateView(e, t), z.val(t))
                            }),
                            z = e(a).change(function() {
                                var e = parseInt(z.val()),
                                    t = parseInt(H ? Math.round(e * U) : P.val());
                                t > 0 && e > 0 && (Y.updateView(t, e), P.val(t))
                            }),
                            A = e(a).change(function() {
                                Z.updateView()
                            }),
                            O = e(a).change(function() {
                                Z.updateView()
                            }),
                            D = e(a).change(function() {
                                Z.updateView()
                            }),
                            M = e(a).change(function() {
                                Z.updateView()
                            }),
                            S = e('<input type="text" size="3" maxlength="3" value="0" />').change(function() {
                                Q.update()
                            }),
                            E = e('<div class="elfinder-resize-rotate-slider"/>').slider({
                                min: 0,
                                max: 359,
                                value: S.val(),
                                animate: !0,
                                change: function(e, t) {
                                    t.value != E.slider("value") && Q.update(t.value)
                                },
                                slide: function(e, t) {
                                    Q.update(t.value, !1)
                                }
                            }),
                            U = 1,
                            j = 1,
                            R = 0,
                            q = 0,
                            H = !0,
                            N = 0,
                            L = 0,
                            _ = 0,
                            W = 0,
                            V = 0,
                            $ = e("<img/>").load(function() {
                                p.remove(), R = $.width(), q = $.height(), U = R / q, Y.updateView(R, q), u.append($.show()).show(), P.val(R), z.val(q);
                                var t = Math.min(N, L) / Math.sqrt(Math.pow(R, 2) + Math.pow(q, 2));
                                _ = R * t, W = q * t, I.button("enable"), d.find("input,select").removeAttr("disabled").filter(":text").keydown(function(t) {
                                    var n, i = t.keyCode;
                                    return t.stopPropagation(), i >= 37 && 40 >= i || i == e.ui.keyCode.BACKSPACE || i == e.ui.keyCode.DELETE || 65 == i && (t.ctrlKey || t.metaKey) || 27 == i ? void 0 : (9 == i && (n = e(this).parent()[t.shiftKey ? "prev" : "next"](".elfinder-resize-row").children(":text"), n.length ? n.focus() : e(this).parent().parent().find(":text:" + (t.shiftKey ? "last" : "first")).focus()), 13 == i ? (r.confirm({
                                        title: e("input:checked", T).val(),
                                        text: "confirmReq",
                                        accept: {
                                            label: "btnApply",
                                            callback: function() {
                                                it()
                                            }
                                        },
                                        cancel: {
                                            label: "btnCancel",
                                            callback: function() {}
                                        }
                                    }), void 0) : (i >= 48 && 57 >= i || i >= 96 && 105 >= i || t.preventDefault(), void 0))
                                }).filter(":first").focus(), et(), C.hover(function() {
                                    C.toggleClass("ui-state-hover")
                                }).click(X)
                            }).error(function() {
                                p.text("Unable to load image").css("background", "transparent")
                            }),
                            B = e("<div/>"),
                            K = e("<img/>"),
                            J = e("<div/>"),
                            G = e("<img/>"),
                            X = function() {
                                P.val(R), z.val(q), Y.updateView(R, q)
                            },
                            Y = {
                                update: function() {
                                    P.val(Math.round($.width() / j)), z.val(Math.round($.height() / j))
                                },
                                updateView: function(e, t) {
                                    e > N || t > L ? e / N > t / L ? (j = N / e, $.width(N).height(Math.ceil(t * j))) : (j = L / t, $.height(L).width(Math.ceil(e * j))) : $.width(e).height(t), j = $.width() / e, k.text("1 : " + (1 / j).toFixed(2)), Y.updateHandle()
                                },
                                updateHandle: function() {
                                    u.width($.width()).height($.height())
                                },
                                fixWidth: function() {
                                    var e, t;
                                    H && (t = z.val(), t = Math.round(t * U), Y.updateView(e, t), P.val(e))
                                },
                                fixHeight: function() {
                                    var e, t;
                                    H && (e = P.val(), t = Math.round(e / U), Y.updateView(e, t), z.val(t))
                                }
                            },
                            Z = {
                                update: function() {
                                    D.val(Math.round((h.data("w") || h.width()) / j)), M.val(Math.round((h.data("h") || h.height()) / j)), A.val(Math.round(((h.data("x") || h.offset().left) - K.offset().left) / j)), O.val(Math.round(((h.data("y") || h.offset().top) - K.offset().top) / j))
                                },
                                updateView: function() {
                                    var e = parseInt(A.val()) * j + K.offset().left,
                                        t = parseInt(O.val()) * j + K.offset().top,
                                        n = D.val() * j,
                                        i = M.val() * j;
                                    h.data({
                                        x: e,
                                        y: t,
                                        w: n,
                                        h: i
                                    }), h.width(Math.round(n)), h.height(Math.round(i)), J.width(h.width()), J.height(h.height()), h.offset({
                                        left: Math.round(e),
                                        top: Math.round(t)
                                    })
                                },
                                resize_update: function() {
                                    h.data({
                                        w: null,
                                        h: null
                                    }), Z.update(), J.width(h.width()), J.height(h.height())
                                },
                                drag_update: function() {
                                    h.data({
                                        x: null,
                                        y: null
                                    }), Z.update()
                                }
                            },
                            Q = {
                                mouseStartAngle: 0,
                                imageStartAngle: 0,
                                imageBeingRotated: !1,
                                update: function(e, t) {
                                    "undefined" == typeof e && (V = e = parseInt(S.val())), "undefined" == typeof t && (t = !0), !t || r.UA.Opera || r.UA.ltIE8 ? G.rotate(e) : G.animate({
                                        rotate: e + "deg"
                                    }), e %= 360, 0 > e && (e += 360), S.val(parseInt(e)), E.slider("value", S.val())
                                },
                                execute: function(e) {
                                    if (Q.imageBeingRotated) {
                                        var t = Q.getCenter(G),
                                            n = e.pageX - t[0],
                                            i = e.pageY - t[1],
                                            r = Math.atan2(i, n),
                                            a = r - Q.mouseStartAngle + Q.imageStartAngle;
                                        return a = Math.round(180 * parseFloat(a) / Math.PI), e.shiftKey && (a = 15 * Math.round((a + 6) / 15)), G.rotate(a), a %= 360, 0 > a && (a += 360), S.val(a), E.slider("value", S.val()), !1
                                    }
                                },
                                start: function(t) {
                                    Q.imageBeingRotated = !0;
                                    var n = Q.getCenter(G),
                                        i = t.pageX - n[0],
                                        r = t.pageY - n[1];
                                    return Q.mouseStartAngle = Math.atan2(r, i), Q.imageStartAngle = parseFloat(G.rotate()) * Math.PI / 180, e(document).mousemove(Q.execute), !1
                                },
                                stop: function() {
                                    return Q.imageBeingRotated ? (e(document).unbind("mousemove", Q.execute), setTimeout(function() {
                                        Q.imageBeingRotated = !1
                                    }, 10), !1) : void 0
                                },
                                getCenter: function() {
                                    var e = G.rotate();
                                    G.rotate(0);
                                    var t = G.offset(),
                                        n = t.left + G.width() / 2,
                                        i = t.top + G.height() / 2;
                                    return G.rotate(e), Array(n, i)
                                }
                            },
                            et = function(t) {
                                e.fn.resizable && (t ? (u.filter(":ui-resizable").resizable("destroy"), u.hide()) : (u.show(), u.resizable({
                                    alsoResize: $,
                                    aspectRatio: H,
                                    resize: Y.update,
                                    stop: Y.fixHeight
                                })))
                            },
                            tt = function(t) {
                                e.fn.draggable && e.fn.resizable && (t ? (h.filter(":ui-resizable").resizable("destroy"), h.filter(":ui-draggable").draggable("destroy"), B.hide()) : (K.width($.width()).height($.height()), J.width($.width()).height($.height()), h.width(K.width()).height(K.height()).offset(K.offset()).resizable({
                                    containment: B,
                                    resize: Z.resize_update,
                                    handles: "all"
                                }).draggable({
                                    handle: J,
                                    containment: K,
                                    drag: Z.drag_update
                                }), B.show().width($.width()).height($.height()), Z.update()))
                            },
                            nt = function(t) {
                                e.fn.draggable && e.fn.resizable && (t ? G.hide() : G.show().width(_).height(W).css("margin-top", (L - W) / 2 + "px").css("margin-left", (N - _) / 2 + "px"))
                            },
                            it = function() {
                                var n, a, s, l, d, c = e("input:checked", T).val();
                                if ("resize" == c) n = parseInt(P.val()) || 0, a = parseInt(z.val()) || 0;
                                else if ("crop" == c) n = parseInt(D.val()) || 0, a = parseInt(M.val()) || 0, s = parseInt(A.val()) || 0, l = parseInt(O.val()) || 0;
                                else if ("rotate" == c) {
                                    if (n = R, a = q, d = parseInt(S.val()) || 0, 0 > d || d > 360) return r.error("Invalid rotate degree");
                                    if (0 == d || 360 == d) return r.error("Image dose not rotated")
                                }
                                if ("rotate" != c) {
                                    if (0 >= n || 0 >= a) return r.error("Invalid image size");
                                    if (n == R && a == q) return r.error("Image size not changed")
                                }
                                i.elfinderdialog("close"), r.request({
                                    data: {
                                        cmd: "resize",
                                        target: t.hash,
                                        width: n,
                                        height: a,
                                        x: s,
                                        y: l,
                                        degree: d,
                                        mode: c
                                    },
                                    notify: {
                                        type: "resize",
                                        cnt: 1
                                    }
                                }).fail(function(e) {
                                    o.reject(e)
                                }).done(function() {
                                    o.resolve()
                                })
                            },
                            rt = {},
                            at = "elfinder-resize-handle-hline",
                            ot = "elfinder-resize-handle-vline",
                            st = "elfinder-resize-handle-point",
                            lt = r.url(t.hash);
                        G.mousedown(Q.start), e(document).mouseup(Q.stop), f.append(e(s).append(e(l).text(r.i18n("width"))).append(P).append(C)).append(e(s).append(e(l).text(r.i18n("height"))).append(z)).append(e(s).append(e("<label/>").text(r.i18n("aspectRatio")).prepend(F))).append(e(s).append(r.i18n("scale") + " ").append(k)), m.append(e(s).append(e(l).text("X")).append(A)).append(e(s).append(e(l).text("Y")).append(O)).append(e(s).append(e(l).text(r.i18n("width"))).append(D)).append(e(s).append(e(l).text(r.i18n("height"))).append(M)), y.append(e(s).append(e(l).text(r.i18n("rotate"))).append(e('<div style="float:left; width: 130px;">').append(e('<div style="float:left;">').append(S).append(e("<span/>").text(r.i18n("degree")))).append(e(g).append(w).append(e(b)).append(x))).append(E)), i.append(T), d.append(e(s)).append(f).append(m.hide()).append(y.hide()).find("input,select").attr("disabled", "disabled"), u.append('<div class="' + at + " " + at + '-top"/>').append('<div class="' + at + " " + at + '-bottom"/>').append('<div class="' + ot + " " + ot + '-left"/>').append('<div class="' + ot + " " + ot + '-right"/>').append('<div class="' + st + " " + st + '-e"/>').append('<div class="' + st + " " + st + '-se"/>').append('<div class="' + st + " " + st + '-s"/>'), c.append(p).append(u.hide()).append($.hide()), h.css("position", "absolute").append('<div class="' + at + " " + at + '-top"/>').append('<div class="' + at + " " + at + '-bottom"/>').append('<div class="' + ot + " " + ot + '-left"/>').append('<div class="' + ot + " " + ot + '-right"/>').append('<div class="' + st + " " + st + '-n"/>').append('<div class="' + st + " " + st + '-e"/>').append('<div class="' + st + " " + st + '-s"/>').append('<div class="' + st + " " + st + '-w"/>').append('<div class="' + st + " " + st + '-ne"/>').append('<div class="' + st + " " + st + '-se"/>').append('<div class="' + st + " " + st + '-sw"/>').append('<div class="' + st + " " + st + '-nw"/>'), c.append(B.css("position", "absolute").hide().append(K).append(h.append(J))), c.append(G.hide()), c.css("overflow", "hidden"), i.append(c).append(d), rt[r.i18n("btnApply")] = it, rt[r.i18n("btnCancel")] = function() {
                            i.elfinderdialog("close")
                        }, r.dialog(i, {
                            title: r.escape(t.name),
                            width: 650,
                            resizable: !1,
                            destroyOnClose: !0,
                            buttons: rt,
                            open: function() {
                                c.zIndex(1 + e(this).parent().zIndex())
                            }
                        }).attr("id", n), r.UA.ltIE8 && e(".elfinder-dialog").css("filter", ""), C.css("left", P.position().left + P.width() + 12), J.css({
                            opacity: .2,
                            "background-color": "#fff",
                            position: "absolute"
                        }), h.css("cursor", "move"), h.find(".elfinder-resize-handle-point").css({
                            "background-color": "#fff",
                            opacity: .5,
                            "border-color": "#000"
                        }), G.css("cursor", "pointer"), T.buttonset(), N = c.width() - (u.outerWidth() - u.width()), L = c.height() - (u.outerHeight() - u.height()), $.attr("src", lt + (-1 === lt.indexOf("?") ? "?" : "&") + "_=" + Math.random()), K.attr("src", $.attr("src")), G.attr("src", $.attr("src"))
                    };
                return a.length && -1 !== a[0].mime.indexOf("image/") ? (n = "resize-" + r.namespace + "-" + a[0].hash, i = r.getUI().find("#" + n), i.length ? (i.elfinderdialog("toTop"), o.resolve()) : (s(a[0], n), o)) : o.reject()
            }
        },
        function(e) {
            var t = function(e, t) {
                var n = 0;
                for (n in t)
                    if ("undefined" != typeof e[t[n]]) return t[n];
                return e[t[n]] = "", t[n]
            };
            if (e.cssHooks.rotate = {
                    get: function(t) {
                        return e(t).rotate()
                    },
                    set: function(t, n) {
                        return e(t).rotate(n), n
                    }
                }, e.cssHooks.transform = {
                    get: function(e) {
                        var n = t(e.style, ["WebkitTransform", "MozTransform", "OTransform", "msTransform", "transform"]);
                        return e.style[n]
                    },
                    set: function(e, n) {
                        var i = t(e.style, ["WebkitTransform", "MozTransform", "OTransform", "msTransform", "transform"]);
                        return e.style[i] = n, n
                    }
                }, e.fn.rotate = function(e) {
                    if ("undefined" == typeof e) {
                        if (window.opera) {
                            var t = this.css("transform").match(/rotate\((.*?)\)/);
                            return t && t[1] ? Math.round(180 * parseFloat(t[1]) / Math.PI) : 0
                        }
                        var t = this.css("transform").match(/rotate\((.*?)\)/);
                        return t && t[1] ? parseInt(t[1]) : 0
                    }
                    return this.css("transform", this.css("transform").replace(/none|rotate\(.*?\)/, "") + "rotate(" + parseInt(e) + "deg)"), this
                }, e.fx.step.rotate = function(t) {
                    0 == t.state && (t.start = e(t.elem).rotate(), t.now = t.start), e(t.elem).rotate(t.now)
                }, "undefined" == typeof window.addEventListener && "undefined" == typeof document.getElementsByClassName) {
                var n = function(e) {
                        for (var t = e, n = t.offsetLeft, i = t.offsetTop; t.offsetParent && (t = t.offsetParent, t == document.body || "static" == t.currentStyle.position);) t != document.body && t != document.documentElement && (n -= t.scrollLeft, i -= t.scrollTop), n += t.offsetLeft, i += t.offsetTop;
                        return {
                            x: n,
                            y: i
                        }
                    },
                    i = function(e) {
                        if ("static" == e.currentStyle.position) {
                            var t = n(e);
                            e.style.position = "absolute", e.style.left = t.x + "px", e.style.top = t.y + "px"
                        }
                    },
                    r = function(e, t) {
                        var n, r = 1,
                            a = 1,
                            o = 1,
                            s = 1;
                        if ("undefined" != typeof e.style.msTransform) return !0;
                        i(e), n = t.match(/rotate\((.*?)\)/);
                        var l = n && n[1] ? parseInt(n[1]) : 0;
                        l %= 360, 0 > l && (l = 360 + l);
                        var d = l * Math.PI / 180,
                            c = Math.cos(d),
                            p = Math.sin(d);
                        r *= c, a *= -p, o *= p, s *= c, e.style.filter = (e.style.filter || "").replace(/progid:DXImageTransform\.Microsoft\.Matrix\([^)]*\)/, "") + ("progid:DXImageTransform.Microsoft.Matrix(M11=" + r + ",M12=" + a + ",M21=" + o + ",M22=" + s + ",FilterType='bilinear',sizingMethod='auto expand')");
                        var u = parseInt(e.style.width || e.width || 0),
                            h = parseInt(e.style.height || e.height || 0),
                            d = l * Math.PI / 180,
                            f = Math.abs(Math.cos(d)),
                            m = Math.abs(Math.sin(d)),
                            g = (u - (u * f + h * m)) / 2,
                            v = (h - (u * m + h * f)) / 2;
                        return e.style.marginLeft = Math.floor(g) + "px", e.style.marginTop = Math.floor(v) + "px", !0
                    },
                    a = e.cssHooks.transform.set;
                e.cssHooks.transform.set = function(e, t) {
                    return a.apply(this, [e, t]), r(e, t), t
                }
            }
        }(jQuery), elFinder.prototype.commands.rm = function() {
            this.shortcuts = [{
                pattern: "delete ctrl+backspace"
            }], this.getstate = function(t) {
                var n = this.fm;
                return t = t || n.selected(), !this._disabled && t.length && e.map(t, function(e) {
                    var t = n.file(e);
                    return t && t.phash && !t.locked ? e : null
                }).length == t.length ? 0 : -1
            }, this.exec = function(t) {
                var n = this,
                    i = this.fm,
                    r = e.Deferred().fail(function(e) {
                        e && i.error(e)
                    }),
                    a = this.files(t),
                    o = a.length,
                    s = i.cwd().hash,
                    l = !1;
                return !o || this._disabled ? r.reject() : (e.each(a, function(e, t) {
                    return t.phash ? t.locked ? !r.reject(["errLocked", t.name]) : (t.hash == s && (l = i.root(t.hash)), void 0) : !r.reject(["errRm", t.name, "errPerm"])
                }), "pending" == r.state() && (a = this.hashes(t), i.confirm({
                    title: n.title,
                    text: "confirmRm",
                    accept: {
                        label: "btnRm",
                        callback: function() {
                            i.lockfiles({
                                files: a
                            }), i.request({
                                data: {
                                    cmd: "rm",
                                    targets: a
                                },
                                notify: {
                                    type: "rm",
                                    cnt: o
                                },
                                preventFail: !0
                            }).fail(function(e) {
                                r.reject(e)
                            }).done(function(e) {
                                r.done(e), l && i.exec("open", l)
                            }).always(function() {
                                i.unlockfiles({
                                    files: a
                                })
                            })
                        }
                    },
                    cancel: {
                        label: "btnCancel",
                        callback: function() {
                            r.reject()
                        }
                    }
                })), r)
            }
        }, elFinder.prototype.commands.search = function() {
            this.title = "Find files", this.options = {
                ui: "searchbutton"
            }, this.alwaysEnabled = !0, this.updateOnSelect = !1, this.getstate = function() {
                return 0
            }, this.exec = function(t) {
                var n = this.fm;
                return "string" == typeof t && t ? (n.trigger("searchstart", {
                    query: t
                }), n.request({
                    data: {
                        cmd: "search",
                        q: t
                    },
                    notify: {
                        type: "search",
                        cnt: 1,
                        hideCnt: !0
                    }
                })) : (n.getUI("toolbar").find("." + n.res("class", "searchbtn") + " :text").focus(), e.Deferred().reject())
            }
        }, elFinder.prototype.commands.sort = function() {
            var t = this,
                n = t.fm;
            this.options = {
                ui: "sortbutton"
            }, n.bind("open sortchange", function() {
                t.variants = [], e.each(n.sortRules, function(e) {
                    var i = {
                            type: e,
                            order: e == n.sortType ? "asc" == n.sortOrder ? "desc" : "asc" : n.sortOrder
                        },
                        r = e == n.sortType ? "asc" == i.order ? "n" : "s" : "";
                    t.variants.push([i, (r ? '<span class="ui-icon ui-icon-arrowthick-1-' + r + '"></span>' : "") + "&nbsp;" + n.i18n("sort" + e)])
                })
            }), n.bind("open sortchange viewchange", function() {
                var i = null;
                i && clearTimeout(i), i = setTimeout(function() {
                    var i = e(n.cwd).find("div.elfinder-cwd-wrapper-list table");
                    i.length && e.each(n.sortRules, function(r) {
                        var a = i.find("thead tr td.elfinder-cwd-view-th-" + r);
                        if (a.length) {
                            var o, s = r == n.sortType,
                                l = {
                                    type: r,
                                    order: s ? "asc" == n.sortOrder ? "desc" : "asc" : n.sortOrder
                                };
                            s && (o = "asc" == n.sortOrder ? "n" : "s", e('<span class="ui-icon ui-icon-triangle-1-' + o + '"/>').css({
                                left: "+center+"
                            }).appendTo(a)), e(a).on("click", function(e) {
                                e.stopPropagation(), t.exec([], l)
                            }).hover(function() {
                                e(this).addClass("ui-state-hover")
                            }, function() {
                                e(this).removeClass("ui-state-hover")
                            })
                        }
                    })
                }, 100)
            }), this.getstate = function() {
                return 0
            }, this.exec = function(t, n) {
                var i = this.fm,
                    r = e.extend({
                        type: i.sortType,
                        order: i.sortOrder,
                        stick: i.sortStickFolders
                    }, n);
                return this.fm.setSort(r.type, r.order, r.stick), e.Deferred().resolve()
            }
        }, elFinder.prototype.commands.up = function() {
            this.alwaysEnabled = !0, this.updateOnSelect = !1, this.shortcuts = [{
                pattern: "ctrl+up"
            }], this.getstate = function() {
                return this.fm.cwd().phash ? 0 : -1
            }, this.exec = function() {
                return this.fm.cwd().phash ? this.fm.exec("open", this.fm.cwd().phash) : e.Deferred().reject()
            }
        }, elFinder.prototype.commands.upload = function() {
            var t = this.fm.res("class", "hover");
            this.disableOnSearch = !0, this.updateOnSelect = !1, this.shortcuts = [{
                pattern: "ctrl+u"
            }], this.getstate = function() {
                return !this._disabled && this.fm.cwd().write ? 0 : -1
            }, this.exec = function(n) {
                var i, r, a, o, s, l = this.fm,
                    d = function(e) {
                        r.elfinderdialog("close"), l.upload(e).fail(function(e) {
                            i.reject(e)
                        }).done(function(e) {
                            i.resolve(e)
                        })
                    };
                return this.disabled() ? e.Deferred().reject() : n && (n.input || n.files) ? l.upload(n) : (i = e.Deferred(), a = e('<input type="file" multiple="true"/>').change(function() {
                    d({
                        input: a[0]
                    })
                }), o = e('<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">' + l.i18n("selectForUpload") + "</span></div>").append(e("<form/>").append(a)).hover(function() {
                    o.toggleClass(t)
                }), r = e('<div class="elfinder-upload-dialog-wrapper"/>').append(o), l.dragUpload && (s = e('<div class="ui-corner-all elfinder-upload-dropbox">' + l.i18n("dropFiles") + "</div>").prependTo(r).after('<div class="elfinder-upload-dialog-or">' + l.i18n("or") + "</div>")[0], s.addEventListener("dragenter", function(n) {
                    n.stopPropagation(), n.preventDefault(), e(s).addClass(t)
                }, !1), s.addEventListener("dragleave", function(n) {
                    n.stopPropagation(), n.preventDefault(), e(s).removeClass(t)
                }, !1), s.addEventListener("dragover", function(e) {
                    e.stopPropagation(), e.preventDefault()
                }, !1), s.addEventListener("drop", function(e) {
                    e.stopPropagation(), e.preventDefault(), d({
                        files: e.dataTransfer.files
                    })
                }, !1)), l.dialog(r, {
                    title: this.title,
                    modal: !0,
                    resizable: !1,
                    destroyOnClose: !0
                }), i)
            }
        }, elFinder.prototype.commands.view = function() {
            this.value = this.fm.viewType, this.alwaysEnabled = !0, this.updateOnSelect = !1, this.options = {
                ui: "viewbutton"
            }, this.getstate = function() {
                return 0
            }, this.exec = function() {
                var e = this.fm.storage("view", "list" == this.value ? "icons" : "list");
                this.fm.viewchange(), this.update(void 0, e)
            }
        }
}(jQuery);