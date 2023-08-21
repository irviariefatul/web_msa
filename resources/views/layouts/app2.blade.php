<!doctype html>
<html lang="en">

<head>
    <title>MSA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('login-form-17/css/style.css') }}">
    <script nonce="5337126e-4a84-4822-85e2-042a02caa1d7">
        (function(w, d) {
            ! function(bt, bu, bv, bw) {
                bt[bv] = bt[bv] || {};
                bt[bv].executed = [];
                bt.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bt.zaraz.q = [];
                bt.zaraz._f = function(bx) {
                    return function() {
                        var by = Array.prototype.slice.call(arguments);
                        bt.zaraz.q.push({
                            m: bx,
                            a: by
                        })
                    }
                };
                for (const bz of ["track", "set", "debug"]) bt.zaraz[bz] = bt.zaraz._f(bz);
                bt.zaraz.init = () => {
                    var bA = bu.getElementsByTagName(bw)[0],
                        bB = bu.createElement(bw),
                        bC = bu.getElementsByTagName("title")[0];
                    bC && (bt[bv].t = bu.getElementsByTagName("title")[0].text);
                    bt[bv].x = Math.random();
                    bt[bv].w = bt.screen.width;
                    bt[bv].h = bt.screen.height;
                    bt[bv].j = bt.innerHeight;
                    bt[bv].e = bt.innerWidth;
                    bt[bv].l = bt.location.href;
                    bt[bv].r = bu.referrer;
                    bt[bv].k = bt.screen.colorDepth;
                    bt[bv].n = bu.characterSet;
                    bt[bv].o = (new Date).getTimezoneOffset();
                    if (bt.dataLayer)
                        for (const bG of Object.entries(Object.entries(dataLayer).reduce(((bH, bI) => ({
                                ...bH[1],
                                ...bI[1]
                            })), {}))) zaraz.set(bG[0], bG[1], {
                            scope: "page"
                        });
                    bt[bv].q = [];
                    for (; bt.zaraz.q.length;) {
                        const bJ = bt.zaraz.q.shift();
                        bt[bv].q.push(bJ)
                    }
                    bB.defer = !0;
                    for (const bK of [localStorage, sessionStorage]) Object.keys(bK || {}).filter((bM => bM
                        .startsWith("_zaraz_"))).forEach((bL => {
                        try {
                            bt[bv]["z_" + bL.slice(7)] = JSON.parse(bK.getItem(bL))
                        } catch {
                            bt[bv]["z_" + bL.slice(7)] = bK.getItem(bL)
                        }
                    }));
                    bB.referrerPolicy = "origin";
                    bB.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bt[bv])));
                    bA.parentNode.insertBefore(bB, bA)
                };
                ["complete", "interactive"].includes(bu.readyState) ? zaraz.init() : bt.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <h2>Welcome to MSA</h2>
                                <img src="{{ asset('Images/ikon-circle.png') }}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="{{ asset('login-form-17/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login-form-17/js/popper.js') }}"></script>
    <script src="{{ asset('login-form-17/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-form-17/js/main.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"7f0c3a2d2ad8049e","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.7.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
