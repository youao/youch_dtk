import { isPc } from '@/utils';
! function(w, d) {
    function setRootFs() {
        elMeta.setAttribute('content', 'width=device-width,maximum-scale=' + scale + ',minimum-scale=' + scale + ',initial-scale=1,user-scalable=0');
        var fs = isPc() ? 10 : de.clientWidth * 10 / 375;
        de.style.fontSize = fs + "px";
        setBodyFs();

        function setBodyFs() {
            d.body ? d.body.style.fontSize = fs * 1.4 + "px" : d.addEventListener("DOMContentLoaded", setBodyFs)
        }
    }

    var de = d.documentElement,
        dpr = w.devicePixelRatio || 1,
        scale = Math.floor(100 / dpr) / 100,
        elMeta = d.querySelector('meta[name="viewport"]')

    setRootFs(), w.addEventListener("resize", setRootFs), w.addEventListener("pageshow", function(e) { e.persisted && setRootFs() });

}(window, document);