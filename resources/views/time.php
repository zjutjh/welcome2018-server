<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>精弘网络</title>
    <script>!function (a, b, c) {
            function q() {
                var d = Math.min((o ? e[h]().width : f.innerWidth) / (a / b), c);
                d != p && (k.innerHTML = "html{font-size:" + d + "px!important;" + n + "}", p = d)
            }

            function r() {
                clearTimeout(l), l = setTimeout(q, 500)
            }

            var l, d = document, e = d.documentElement, f = window, g = "addEventListener", h = "getBoundingClientRect",
                i = "pageshow", j = d.head || d.getElementsByTagName("HEAD")[0], k = d.createElement("STYLE"),
                m = "text-size-adjust:100%;", n = "-webkit-" + m + "-moz-" + m + "-ms-" + m + "-o-" + m + m, o = h in e,
                p = null;
            a = a || 320, b = b || 16, c = c || 32, j.appendChild(k), d[g]("DOMContentLoaded", q, !1), "on" + i in f ? f[g](i, function (a) {
                a.persisted && r()
            }, !1) : f[g]("load", r, !1), f[g]("resize", r, !1), q()
        }(320, 10, 100);</script>
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }
        body{
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: 0;
        }
        #app {
            font-family: 'Avenir', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-align: center;
            color: #2c3e50;
            width: 100%;
            height: 100%;
            /*margin-top: 60px;*/
        }
        .content{
            /*position: absolute;*/
            box-sizing: border-box;
            padding: 1px;
            margin: 0;
            width: 100%;
            height: 100%;
            /*height: 83.3125rem;*/
            /*width: 46.875rem;*/
            background-image: linear-gradient(120deg, #5694dc 0%, #c2e9fb 90%);
        }
        .logo{
            margin-top: 9rem;
        }
        .logo1{
            /*position: relative;*/
            /*top: 9rem;*/
            width:24%;
            height:24%;
        }
        .resultpage{
            margin-top: 3rem;
            position: relative;
            /*top:15rem;*/
            margin-left: auto;
            margin-right: auto;
            height: 30%;
            width: 80%;
            background-color:rgba(255,255,255,0.5);
            border-radius:1.5rem;
            /*box-shadow: 0.25rem 0.25rem 1rem #888888;*/
        }
        .logo-background{
            /*margin-right: auto;
            margin-left: auto;
            height: 24rem;*/
            height: 90%;
            overflow: auto;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            opacity: 0.1;
        }
        .text{
            text-align: left;
            position: relative;
            font-size:2.1rem;
            line-height: 2rem;
            color: rgb(19,63,106);
        }
        .text .label-item{
            display: inline-block;
            width: 12rem;
            text-align: right;
        }
        .text-item{

        }
        .resultbutton{
            margin-top: 5rem;
            /*position: absolute;*/
            /*left: 29.375rem;*/
            /*top: 56rem;*/
            width: 11.75rem;
            height: 4.125rem;
            border: 0.125rem white solid;
            background: rgba(255, 255, 255, 0);
            color: white;
            font-size: 2rem;
            font-style: normal;
        }
        .resultbutton02{
            margin-top: 2rem;
            /*position: absolute;*/
            /*left: 29.375rem;*/
            /*top: 56rem;*/
            width: 11.75rem;
            height: 4.125rem;
            border: 0.125rem white solid;
            background: rgba(255, 255, 255, 0);
            color: white;
            font-size: 2rem;
            font-style: normal;
        }
        .footer{
            width: 100%;
        }
        .tip{
            font-size: 1.5rem;
            border-radius: 1rem;
            background: rgba(255,255,255,.6);
            margin: 0 5rem;
            margin-top: 1rem;
            padding: .1rem;
        }
        .cr{
            text-align: center;
            color: #6585be;
            font-size: 1.75rem;
            margin: 2rem;
        }
    </style>
</head>
<body>
<div class="content" id="app">
    <div class="logo">
        <img class="logo1" src="/logo.png">
    </div>
    <div class="resultpage">
        <div class="schoollogo">
            <img class="logo-background" src="/school.png">
        </div>
        <div class="text" style="padding-top: 2rem">
            <p style="text-align: center;">未开放查询</p>
            <!--<p class="text-item"><span class="label-item">姓名：</span>{{ data.student.name}}</p>-->
            <!--<p class="text-item"><span class="label-item">学号：</span>{{ data.student.student_id}}</p>-->
            <!--<p class="text-item"><span class="label-item">班级：</span>{{data.student.class}}</p>-->
            <!--<p class="text-item"><span class="label-item">班主任：</span>{{data.student.head_teacher}}</p>-->
            <!--<p class="text-item" v-if="data.qq_groups"><span class="label-item">家乡群：</span>{{data.qq_groups.qq_group}}</p>-->
        </div>
    </div>
    <div class="footer">
        <div class="tip">
            <p>小贴士</p>
            <p><?php echo $tip->content; ?></p>

        </div>
        <p class="cr">©浙江工业大学精弘网络</p>
    </div>


</div>

</body>
</html>