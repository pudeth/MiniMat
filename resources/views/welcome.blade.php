<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKD POS -POINT OF SELL</title>
    
    @auth
        @if(auth()->user()->role === 'admin')
            <meta http-equiv="refresh" content="0;url={{ route('admin.dashboard') }}">
        @else
            <meta http-equiv="refresh" content="0;url={{ route('pos.index') }}">
        @endif
    @endauth
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/css/khmer-fonts.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700;900&family=IBM+Plex+Mono:wght@400;600;700&family=Noto+Sans+Khmer:wght@400;700;900&family=Noto+Sans+SC:wght@400;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'IBM Plex Mono', monospace;
            overflow-x: hidden;
            background: #f5f5f5;
        }
        
        body.lang-km {
            font-family: 'Noto Sans Khmer', 'Battambang', sans-serif;
        }
        
        body.lang-zh {
            font-family: 'Noto Sans SC', sans-serif;
        }
        
        .heading-font {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }
        
        .lang-km .heading-font {
            font-family: 'Noto Sans Khmer', 'Battambang', sans-serif;
            text-transform: none;
        }
        
        .lang-zh .heading-font {
            font-family: 'Noto Sans SC', sans-serif;
            text-transform: none;
        }
        
        .lang-switcher {
            display: flex;
            gap: 0.5rem;
        }
        
        .lang-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #000;
            background: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .lang-btn:hover {
            background: #fef08a;
        }
        
        .lang-btn.active {
            background: #000;
            color: #fff;
        }
        
        .translate {
            display: none;
        }
        
        .translate.active {
            display: block;
        }
        
        .translate-inline {
            display: none;
        }
        
        .translate-inline.active {
            display: inline;
        }
        
        .translate-flex {
            display: none;
        }
        
        .translate-flex.active {
            display: flex;
        }
        
        /* Brutalist Elements */
        .brutal-border {
            border: 4px solid #000;
            box-shadow: 8px 8px 0 #000;
        }
        
        .brutal-border-thick {
            border: 6px solid #000;
            box-shadow: 12px 12px 0 #000;
        }
        
        .brutal-shadow {
            box-shadow: 8px 8px 0 #000;
        }
        
        .brutal-shadow-hover:hover {
            transform: translate(4px, 4px);
            box-shadow: 4px 4px 0 #000;
        }
        
        /* Scroll Animations */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .scroll-slide-left {
            opacity: 0;
            transform: translateX(-100px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .scroll-slide-left.active {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-slide-right {
            opacity: 0;
            transform: translateX(100px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .scroll-slide-right.active {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-scale {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .scroll-scale.active {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Parallax Effect */
        .parallax {
            transition: transform 0.1s ease-out;
        }
        
        /* Glitch Effect */
        .glitch {
            position: relative;
        }
        
        .glitch:hover::before,
        .glitch:hover::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch:hover::before {
            animation: glitch-1 0.3s infinite;
            color: #ff00ff;
            z-index: -1;
        }
        
        .glitch:hover::after {
            animation: glitch-2 0.3s infinite;
            color: #00ffff;
            z-index: -2;
        }
        
        @keyframes glitch-1 {
            0%, 100% { transform: translate(0); }
            33% { transform: translate(-2px, 2px); }
            66% { transform: translate(2px, -2px); }
        }
        
        @keyframes glitch-2 {
            0%, 100% { transform: translate(0); }
            33% { transform: translate(2px, -2px); }
            66% { transform: translate(-2px, 2px); }
        }
        
        /* Rotating Border */
        .rotating-border {
            position: relative;
            overflow: hidden;
        }
        
        .rotating-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff00ff, #00ffff, #ffff00, #ff00ff);
            background-size: 400%;
            animation: rotate-gradient 3s linear infinite;
            z-index: -1;
        }
        
        @keyframes rotate-gradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 400% 50%; }
        }
        
        /* Noise Texture */
        .noise {
            position: relative;
        }
        
        .noise::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.03;
            pointer-events: none;
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Button Hover */
        .brutal-btn {
            transition: all 0.2s ease;
        }
        
        .brutal-btn:hover {
            transform: translate(2px, 2px);
        }
        
        .brutal-btn:active {
            transform: translate(4px, 4px);
            box-shadow: 4px 4px 0 #000;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white border-b-4 border-black fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-black flex items-center justify-center brutal-shadow">
                        <span class="text-white text-2xl font-bold">⚡</span>
                    </div>
                    <h1 class="text-3xl font-black heading-font">KKD</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Language Switcher -->
                    <div class="lang-switcher mr-4">
                        <button class="lang-btn active" data-lang="en">EN</button>
                        <button class="lang-btn" data-lang="km">ខ្មែរ</button>
                        <button class="lang-btn" data-lang="zh">中文</button>
                    </div>
                    
                    @auth
                        <a href="{{ route('pos.index') }}" class="bg-yellow-400 text-black px-5 py-2 border-2 border-black font-bold uppercase text-sm hover:bg-yellow-300 transition-all brutal-btn">
                            <span class="translate active" data-lang="en">POS</span>
                            <span class="translate" data-lang="km">ប្រព័ន្ធលក់</span>
                            <span class="translate" data-lang="zh">销售系统</span>
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="bg-white text-black px-5 py-2 border-2 border-black font-bold uppercase text-sm hover:bg-gray-100 transition-all brutal-btn">
                            <span class="translate active" data-lang="en">DASH</span>
                            <span class="translate" data-lang="km">ផ្ទាំងគ្រប់គ្រង</span>
                            <span class="translate" data-lang="zh">仪表板</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-black text-white px-5 py-2 border-2 border-black font-bold uppercase text-sm hover:bg-gray-900 transition-all brutal-btn">
                                <span class="translate active" data-lang="en">OUT</span>
                                <span class="translate" data-lang="km">ចាកចេញ</span>
                                <span class="translate" data-lang="zh">退出</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-black text-white px-6 py-3 border-2 border-black font-bold uppercase text-sm hover:bg-gray-900 transition-all brutal-btn">
                            <span class="translate active" data-lang="en">LOGIN</span>
                            <span class="translate" data-lang="km">ចូលប្រើ</span>
                            <span class="translate" data-lang="zh">登录</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white pt-32 pb-20 relative noise overflow-hidden">
        <!-- Geometric Shapes -->
        <div class="absolute top-20 right-10 w-32 h-32 bg-yellow-400 border-4 border-black rotate-12 scroll-reveal"></div>
        <div class="absolute bottom-20 left-10 w-40 h-40 bg-pink-400 border-4 border-black -rotate-6 scroll-reveal"></div>
        <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-cyan-400 border-4 border-black rotate-45 scroll-reveal"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-block mb-8 scroll-scale">
                    <span class="bg-black text-white px-6 py-3 border-4 border-black font-bold uppercase text-sm brutal-shadow">
                         <span>
                            ⚡
                         </span>
                    </span>
                </div>
                
                <h1 class="text-7xl md:text-8xl lg:text-9xl font-black heading-font mb-8 leading-none scroll-reveal glitch" data-text="SELL MORE">
                    <span class="translate active" data-lang="en">SELL<br/>MORE</span>
                    <span class="translate" data-lang="km">លក់បាន<br/>ច្រើន</span>
                    <span class="translate" data-lang="zh">销售<br/>更多</span>
                </h1>
                
                <div class="max-w-3xl mx-auto mb-12 scroll-reveal">
                    <p class="text-xl md:text-2xl font-bold uppercase leading-relaxed">
                        <span class="translate active" data-lang="en">NO BS. JUST PURE POWER. KHQR PAYMENTS + REAL-TIME ANALYTICS + SMART INVENTORY = YOUR SUCCESS</span>
                        <span class="translate" data-lang="km">គ្មានភាពស្មុគស្មាញ។ មានតែថាមពលសុទ្ធ។ ការទូទាត់ KHQR + ការវិភាគពេលវេលាជាក់ស្តែង + សារពើភ័ណ្ឌឆ្លាតវៃ = អាជីវកម្មជោគជ័យ</span>
                        <span class="translate" data-lang="zh">没有废话。只有纯粹的力量。KHQR支付 + 实时分析 + 智能库存 = 您的成功</span>
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-center gap-6 mb-16 scroll-reveal">
                    @auth
                        <a href="{{ route('pos.index') }}" class="brutal-btn bg-black text-white px-12 py-5 border-4 border-black font-black text-lg uppercase brutal-shadow-hover inline-block">
                            <span class="flex items-center justify-center space-x-3">
                                <span class="translate active" data-lang="en">OPEN POS</span>
                                <span class="translate" data-lang="km">បើកប្រព័ន្ធលក់</span>
                                <span class="translate" data-lang="zh">打开销售系统</span>
                                <span class="text-2xl">→</span>
                            </span>
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="brutal-btn bg-yellow-400 text-black px-12 py-5 border-4 border-black font-black text-lg uppercase brutal-shadow-hover inline-block">
                            <span class="translate active" data-lang="en">DASHBOARD</span>
                            <span class="translate" data-lang="km">ផ្ទាំងគ្រប់គ្រង</span>
                            <span class="translate" data-lang="zh">仪表板</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="brutal-btn bg-black text-white px-14 py-6 border-4 border-black font-black text-xl uppercase brutal-shadow-hover inline-block">
                            <span class="flex items-center justify-center space-x-3">
                                <span class="translate active" data-lang="en">START NOW</span>
                                <span class="translate" data-lang="km">ចាប់ផ្តើមឥឡូវ</span>
                                <span class="translate" data-lang="zh">立即开始</span>
                                <span class="text-3xl">→</span>
                            </span>
                        </a>
                    @endauth
                </div>
                
                <!-- Stats Bar -->
                <div class="grid grid-cols-3 gap-4 max-w-3xl mx-auto scroll-reveal">
                    <div class="bg-yellow-400 border-4 border-black p-4 brutal-shadow">
                        <div class="text-3xl font-black heading-font">100%</div>
                        <div class="text-xs font-bold uppercase">
                            <span class="translate active" data-lang="en">SECURE</span>
                            <span class="translate" data-lang="km">សុវត្ថិភាព</span>
                            <span class="translate" data-lang="zh">安全</span>
                        </div>
                    </div>
                    <div class="bg-pink-400 border-4 border-black p-4 brutal-shadow">
                        <div class="text-3xl font-black heading-font">24/7</div>
                        <div class="text-xs font-bold uppercase">
                            <span class="translate active" data-lang="en">ONLINE</span>
                            <span class="translate" data-lang="km">អនឡាញ</span>
                            <span class="translate" data-lang="zh">在线</span>
                        </div>
                    </div>
                    <div class="bg-cyan-400 border-4 border-black p-4 brutal-shadow">
                        <div class="text-3xl font-black heading-font">
                            <span class="translate active" data-lang="en">FAST</span>
                            <span class="translate" data-lang="km">លឿន</span>
                            <span class="translate" data-lang="zh">快速</span>
                        </div>
                        <div class="text-xs font-bold uppercase">
                            <span class="translate active" data-lang="en">CHECKOUT</span>
                            <span class="translate" data-lang="km">ទូទាត់</span>
                            <span class="translate" data-lang="zh">结账</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gray-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 scroll-reveal">
                <div class="inline-block bg-black text-white px-6 py-2 border-4 border-black font-bold uppercase text-sm mb-6 brutal-shadow">
                    <span class="translate active" data-lang="en">FEATURES</span>
                    <span class="translate" data-lang="km">មុខងារ</span>
                    <span class="translate" data-lang="zh">功能</span>
                </div>
                <h2 class="text-6xl md:text-7xl font-black heading-font mb-6">
                    <span class="translate active" data-lang="en">EVERYTHING<br/>YOU NEED</span>
                    <span class="translate" data-lang="km">គ្រប់យ៉ាង<br/>ដែលអ្នកត្រូវការ</span>
                    <span class="translate" data-lang="zh">您需要的<br/>一切</span>
                </h2>
                <p class="text-xl font-bold uppercase max-w-2xl mx-auto">
                    <span class="translate active" data-lang="en">POWERFUL TOOLS. ZERO COMPLEXITY.</span>
                    <span class="translate" data-lang="km">ឧបករណ៍មានថាមពល។ គ្មានភាពស្មុគស្មាញ។</span>
                    <span class="translate" data-lang="zh">强大的工具。零复杂性。</span>
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="scroll-slide-left">
                    <div class="bg-yellow-400 border-4 border-black p-8 brutal-shadow-hover transition-all h-full">
                        <div class="w-20 h-20 bg-black flex items-center justify-center mb-6 border-4 border-black">
                            <span class="text-4xl">💳</span>
                        </div>
                        <h3 class="text-3xl font-black heading-font mb-4">
                            <span class="translate active" data-lang="en">KHQR PAYMENT</span>
                            <span class="translate" data-lang="km">ការទូទាត់ KHQR</span>
                            <span class="translate" data-lang="zh">KHQR支付</span>
                        </h3>
                        <p class="font-bold mb-6 leading-relaxed">
                            <span class="translate active" data-lang="en">INSTANT QR CODE GENERATION. AUTO PAYMENT VERIFICATION. CAMBODIA'S #1 PAYMENT SYSTEM.</span>
                            <span class="translate" data-lang="km">បង្កើតកូដ QR ភ្លាមៗ។ ផ្ទៀងផ្ទាត់ការទូទាត់ស្វ័យប្រវត្តិ។ ប្រព័ន្ធទូទាត់លេខ១ របស់កម្ពុជា។</span>
                            <span class="translate" data-lang="zh">即时生成二维码。自动支付验证。柬埔寨第一支付系统。</span>
                        </p>
                        <ul class="space-y-3 font-bold text-sm">
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">INSTANT QR GENERATION</span>
                                <span class="translate" data-lang="km">បង្កើត QR ភ្លាមៗ</span>
                                <span class="translate" data-lang="zh">即时生成二维码</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">AUTO VERIFICATION</span>
                                <span class="translate" data-lang="km">ផ្ទៀងផ្ទាត់ស្វ័យប្រវត្តិ</span>
                                <span class="translate" data-lang="zh">自动验证</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">SECURE TRANSACTIONS</span>
                                <span class="translate" data-lang="km">ប្រតិបត្តិការសុវត្ថិភាព</span>
                                <span class="translate" data-lang="zh">安全交易</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="scroll-scale">
                    <div class="bg-pink-400 border-4 border-black p-8 brutal-shadow-hover transition-all h-full">
                        <div class="w-20 h-20 bg-black flex items-center justify-center mb-6 border-4 border-black">
                            <span class="text-4xl">📊</span>
                        </div>
                        <h3 class="text-3xl font-black heading-font mb-4">
                            <span class="translate active" data-lang="en">SALES ANALYTICS</span>
                            <span class="translate" data-lang="km">ការវិភាគការលក់</span>
                            <span class="translate" data-lang="zh">销售分析</span>
                        </h3>
                        <p class="font-bold mb-6 leading-relaxed">
                            <span class="translate active" data-lang="en">REAL-TIME DASHBOARD. LIVE TRACKING. REVENUE REPORTS. KNOW YOUR NUMBERS.</span>
                            <span class="translate" data-lang="km">ផ្ទាំងគ្រប់គ្រងពេលវេលាជាក់ស្តែង។ តាមដានផ្ទាល់។ របាយការណ៍ចំណូល។ ដឹងលេខរបស់អ្នក។</span>
                            <span class="translate" data-lang="zh">实时仪表板。实时跟踪。收入报告。了解您的数据。</span>
                        </p>
                        <ul class="space-y-3 font-bold text-sm">
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">LIVE SALES TRACKING</span>
                                <span class="translate" data-lang="km">តាមដានការលក់ផ្ទាល់</span>
                                <span class="translate" data-lang="zh">实时销售跟踪</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">REVENUE REPORTS</span>
                                <span class="translate" data-lang="km">របាយការណ៍ចំណូល</span>
                                <span class="translate" data-lang="zh">收入报告</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">PERFORMANCE INSIGHTS</span>
                                <span class="translate" data-lang="km">ការយល់ដឹងអំពីការអនុវត្ត</span>
                                <span class="translate" data-lang="zh">性能洞察</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="scroll-slide-right">
                    <div class="bg-cyan-400 border-4 border-black p-8 brutal-shadow-hover transition-all h-full">
                        <div class="w-20 h-20 bg-black flex items-center justify-center mb-6 border-4 border-black">
                            <span class="text-4xl">📦</span>
                        </div>
                        <h3 class="text-3xl font-black heading-font mb-4">
                            <span class="translate active" data-lang="en">SMART INVENTORY</span>
                            <span class="translate" data-lang="km">សារពើភ័ណ្ឌឆ្លាតវៃ</span>
                            <span class="translate" data-lang="zh">智能库存</span>
                        </h3>
                        <p class="font-bold mb-6 leading-relaxed">
                            <span class="translate active" data-lang="en">STOCK MONITORING. LOW STOCK ALERTS. CATEGORY MANAGEMENT. STAY IN CONTROL.</span>
                            <span class="translate" data-lang="km">ត្រួតពិនិត្យស្តុក។ ការជូនដំណឹងស្តុកទាប។ ការគ្រប់គ្រងប្រភេទ។ នៅក្នុងការគ្រប់គ្រង។</span>
                            <span class="translate" data-lang="zh">库存监控。低库存警报。类别管理。保持控制。</span>
                        </p>
                        <ul class="space-y-3 font-bold text-sm">
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">STOCK LEVEL MONITORING</span>
                                <span class="translate" data-lang="km">ត្រួតពិនិត្យកម្រិតស្តុក</span>
                                <span class="translate" data-lang="zh">库存水平监控</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">LOW STOCK ALERTS</span>
                                <span class="translate" data-lang="km">ការជូនដំណឹងស្តុកទាប</span>
                                <span class="translate" data-lang="zh">低库存警报</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-xl">▸</span>
                                <span class="translate active" data-lang="en">EASY MANAGEMENT</span>
                                <span class="translate" data-lang="km">ការគ្រប់គ្រងងាយស្រួល</span>
                                <span class="translate" data-lang="zh">轻松管理</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-black text-white relative overflow-hidden">
        <div class="absolute inset-0 noise"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="scroll-reveal">
                    <div class="bg-yellow-400 text-black p-8 border-4 border-white brutal-shadow-hover transition-all">
                        <div class="text-6xl font-black heading-font mb-3">⚡</div>
                        <div class="text-4xl font-black heading-font mb-2">
                            <span class="translate active" data-lang="en">FAST</span>
                            <span class="translate" data-lang="km">លឿន</span>
                            <span class="translate" data-lang="zh">快速</span>
                        </div>
                        <div class="font-bold uppercase text-sm">
                            <span class="translate active" data-lang="en">LIGHTNING CHECKOUT</span>
                            <span class="translate" data-lang="km">ទូទាត់រហ័ស</span>
                            <span class="translate" data-lang="zh">闪电结账</span>
                        </div>
                    </div>
                </div>
                <div class="scroll-reveal">
                    <div class="bg-pink-400 text-black p-8 border-4 border-white brutal-shadow-hover transition-all">
                        <div class="text-6xl font-black heading-font mb-3">🔒</div>
                        <div class="text-4xl font-black heading-font mb-2">
                            <span class="translate active" data-lang="en">SECURE</span>
                            <span class="translate" data-lang="km">សុវត្ថិភាព</span>
                            <span class="translate" data-lang="zh">安全</span>
                        </div>
                        <div class="font-bold uppercase text-sm">
                            <span class="translate active" data-lang="en">BANK-LEVEL SECURITY</span>
                            <span class="translate" data-lang="km">សុវត្ថិភាពកម្រិតធនាគារ</span>
                            <span class="translate" data-lang="zh">银行级安全</span>
                        </div>
                    </div>
                </div>
                <div class="scroll-reveal">
                    <div class="bg-cyan-400 text-black p-8 border-4 border-white brutal-shadow-hover transition-all">
                        <div class="text-6xl font-black heading-font mb-3">✨</div>
                        <div class="text-4xl font-black heading-font mb-2">
                            <span class="translate active" data-lang="en">SIMPLE</span>
                            <span class="translate" data-lang="km">សាមញ្ញ</span>
                            <span class="translate" data-lang="zh">简单</span>
                        </div>
                        <div class="font-bold uppercase text-sm">
                            <span class="translate active" data-lang="en">INTUITIVE INTERFACE</span>
                            <span class="translate" data-lang="km">ចំណុចប្រទាក់ងាយស្រួល</span>
                            <span class="translate" data-lang="zh">直观界面</span>
                        </div>
                    </div>
                </div>
                <div class="scroll-reveal">
                    <div class="bg-white text-black p-8 border-4 border-white brutal-shadow-hover transition-all">
                        <div class="text-6xl font-black heading-font mb-3">🚀</div>
                        <div class="text-4xl font-black heading-font mb-2">
                            <span class="translate active" data-lang="en">MODERN</span>
                            <span class="translate" data-lang="km">ទំនើប</span>
                            <span class="translate" data-lang="zh">现代</span>
                        </div>
                        <div class="font-bold uppercase text-sm">
                            <span class="translate active" data-lang="en">LATEST TECHNOLOGY</span>
                            <span class="translate" data-lang="km">បច្ចេកវិទ្យាថ្មីបំផុត</span>
                            <span class="translate" data-lang="zh">最新技术</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-28 bg-white relative overflow-hidden noise">
        <!-- Geometric Decorations -->
        <div class="absolute top-10 left-10 w-40 h-40 bg-yellow-400 border-4 border-black rotate-12 scroll-reveal"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-pink-400 border-4 border-black -rotate-12 scroll-reveal"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="scroll-scale">
                <div class="bg-black text-white p-16 border-8 border-black brutal-border-thick">
                    <h2 class="text-5xl md:text-7xl font-black heading-font mb-8 leading-tight">
                        <span class="translate active" data-lang="en">READY TO<br/>DOMINATE?</span>
                        <span class="translate" data-lang="km">ត្រៀមខ្លួន<br/>ដើម្បីជោគជ័យ?</span>
                        <span class="translate" data-lang="zh">准备好<br/>主导了吗？</span>
                    </h2>
                    <p class="text-xl md:text-2xl font-bold uppercase mb-12 max-w-2xl mx-auto">
                        <span class="translate active" data-lang="en">JOIN THOUSANDS OF BUSINESSES CRUSHING IT WITH POSPAY</span>
                        <span class="translate" data-lang="km">ចូលរួមជាមួយអាជីវកម្មរាប់ពាន់ដែលទទួលបានជោគជ័យជាមួយ POSPAY</span>
                        <span class="translate" data-lang="zh">加入数千家使用POSPAY取得成功的企业</span>
                    </p>
                    @auth
                        <a href="{{ route('pos.index') }}" class="brutal-btn inline-block bg-yellow-400 text-black px-14 py-6 border-4 border-white font-black text-xl uppercase brutal-shadow-hover">
                            <span class="flex items-center justify-center space-x-3">
                                <span class="translate active" data-lang="en">START SELLING</span>
                                <span class="translate" data-lang="km">ចាប់ផ្តើមលក់</span>
                                <span class="translate" data-lang="zh">开始销售</span>
                                <span class="text-3xl">→</span>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="brutal-btn inline-block bg-yellow-400 text-black px-14 py-6 border-4 border-white font-black text-xl uppercase brutal-shadow-hover">
                            <span class="flex items-center justify-center space-x-3">
                                <span class="translate active" data-lang="en">GET STARTED</span>
                                <span class="translate" data-lang="km">ចាប់ផ្តើម</span>
                                <span class="translate" data-lang="zh">开始使用</span>
                                <span class="text-3xl">→</span>
                            </span>
                        </a>
                    @endauth
                    
                    <div class="mt-10 flex flex-wrap justify-center items-center gap-6 text-white/80 font-bold text-sm uppercase">
                        <div class="flex items-center space-x-2">
                            <span class="text-yellow-400 text-xl">✓</span>
                            <span class="translate active" data-lang="en">NO CREDIT CARD</span>
                            <span class="translate" data-lang="km">មិនត្រូវការកាតឥណទាន</span>
                            <span class="translate" data-lang="zh">无需信用卡</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-yellow-400 text-xl">✓</span>
                            <span class="translate active" data-lang="en">5 MIN SETUP</span>
                            <span class="translate" data-lang="km">រៀបចំ ៥ នាទី</span>
                            <span class="translate" data-lang="zh">5分钟设置</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-yellow-400 text-xl">✓</span>
                            <span class="translate active" data-lang="en">CANCEL ANYTIME</span>
                            <span class="translate" data-lang="km">បោះបង់ពេលណាក៏បាន</span>
                            <span class="translate" data-lang="zh">随时取消</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-16 border-t-8 border-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-yellow-400 flex items-center justify-center border-4 border-white">
                            <span class="text-3xl">⚡</span>
                        </div>
                        <h3 class="text-4xl font-black heading-font">KKD</h3>
                    </div>
                    <p class="font-bold uppercase leading-relaxed mb-6 max-w-md text-gray-300">
                        <span class="translate active" data-lang="en">BRUTALIST KKD SYSTEM. KHQR PAYMENTS. BUILT FOR BUSINESSES THAT MOVE FAST.</span>
                        <span class="translate" data-lang="km">ប្រព័ន្ធ KKD ទំនើប។ ការទូទាត់ KHQR។ បង្កើតឡើងសម្រាប់អាជីវកម្មដែលរីកចម្រើនលឿន។</span>
                        <span class="translate" data-lang="zh">现代POS系统。KHQR支付。为快速发展的企业而建。</span>
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-white text-black hover:bg-yellow-400 flex items-center justify-center border-2 border-white transition-all font-bold">
                            F
                        </a>
                        <a href="#" class="w-12 h-12 bg-white text-black hover:bg-pink-400 flex items-center justify-center border-2 border-white transition-all font-bold">
                            T
                        </a>
                        <a href="#" class="w-12 h-12 bg-white text-black hover:bg-cyan-400 flex items-center justify-center border-2 border-white transition-all font-bold">
                            G
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-black heading-font mb-6 uppercase">
                        <span class="translate active" data-lang="en">QUICK LINKS</span>
                        <span class="translate" data-lang="km">តំណភ្ជាប់រហ័ស</span>
                        <span class="translate" data-lang="zh">快速链接</span>
                    </h4>
                    <ul class="space-y-3">
                        @auth
                            <li>
                                <a href="{{ route('pos.index') }}" class="font-bold uppercase text-sm hover:text-yellow-400 transition-colors flex items-center space-x-2">
                                    <span>▸</span>
                                    <span class="translate active" data-lang="en">POS SYSTEM</span>
                                    <span class="translate" data-lang="km">ប្រព័ន្ធលក់</span>
                                    <span class="translate" data-lang="zh">销售系统</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="font-bold uppercase text-sm hover:text-yellow-400 transition-colors flex items-center space-x-2">
                                    <span>▸</span>
                                    <span class="translate active" data-lang="en">DASHBOARD</span>
                                    <span class="translate" data-lang="km">ផ្ទាំងគ្រប់គ្រង</span>
                                    <span class="translate" data-lang="zh">仪表板</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products') }}" class="font-bold uppercase text-sm hover:text-yellow-400 transition-colors flex items-center space-x-2">
                                    <span>▸</span>
                                    <span class="translate active" data-lang="en">PRODUCTS</span>
                                    <span class="translate" data-lang="km">ផលិតផល</span>
                                    <span class="translate" data-lang="zh">产品</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="font-bold uppercase text-sm hover:text-yellow-400 transition-colors flex items-center space-x-2">
                                    <span>▸</span>
                                    <span class="translate active" data-lang="en">LOGIN</span>
                                    <span class="translate" data-lang="km">ចូលប្រើ</span>
                                    <span class="translate" data-lang="zh">登录</span>
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-black heading-font mb-6 uppercase">
                        <span class="translate active" data-lang="en">FEATURES</span>
                        <span class="translate" data-lang="km">មុខងារ</span>
                        <span class="translate" data-lang="zh">功能</span>
                    </h4>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-center space-x-2 font-bold uppercase text-sm">
                            <span class="text-yellow-400">✓</span>
                            <span class="translate active" data-lang="en">KHQR PAYMENT</span>
                            <span class="translate" data-lang="km">ការទូទាត់ KHQR</span>
                            <span class="translate" data-lang="zh">KHQR支付</span>
                        </li>
                        <li class="flex items-center space-x-2 font-bold uppercase text-sm">
                            <span class="text-pink-400">✓</span>
                            <span class="translate active" data-lang="en">SALES ANALYTICS</span>
                            <span class="translate" data-lang="km">ការវិភាគការលក់</span>
                            <span class="translate" data-lang="zh">销售分析</span>
                        </li>
                        <li class="flex items-center space-x-2 font-bold uppercase text-sm">
                            <span class="text-cyan-400">✓</span>
                            <span class="translate active" data-lang="en">INVENTORY</span>
                            <span class="translate" data-lang="km">សារពើភ័ណ្ឌ</span>
                            <span class="translate" data-lang="zh">库存</span>
                        </li>
                        <li class="flex items-center space-x-2 font-bold uppercase text-sm">
                            <span class="text-white">✓</span>
                            <span class="translate active" data-lang="en">TELEGRAM ALERTS</span>
                            <span class="translate" data-lang="km">ការជូនដំណឹង Telegram</span>
                            <span class="translate" data-lang="zh">Telegram警报</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t-4 border-white pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="font-bold uppercase text-sm text-gray-300">
                        <span class="translate active" data-lang="en">© {{ date('Y') }} POSPAY. ALL RIGHTS RESERVED.</span>
                        <span class="translate" data-lang="km">© {{ date('Y') }} POSPAY. រក្សាសិទ្ធិគ្រប់យ៉ាង។</span>
                        <span class="translate" data-lang="zh">© {{ date('Y') }} POSPAY. 版权所有。</span>
                    </p>
                    <div class="flex space-x-6 text-sm font-bold uppercase">
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors">
                            <span class="translate active" data-lang="en">PRIVACY</span>
                            <span class="translate" data-lang="km">ភាពឯកជន</span>
                            <span class="translate" data-lang="zh">隐私</span>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors">
                            <span class="translate active" data-lang="en">TERMS</span>
                            <span class="translate" data-lang="km">លក្ខខណ្ឌ</span>
                            <span class="translate" data-lang="zh">条款</span>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 transition-colors">
                            <span class="translate active" data-lang="en">CONTACT</span>
                            <span class="translate" data-lang="km">ទំនាក់ទំនង</span>
                            <span class="translate" data-lang="zh">联系</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        // Language Switching
        let currentLang = localStorage.getItem('language') || 'en';
        
        function setLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('language', lang);
            
            // Update body class for font changes
            document.body.className = document.body.className.replace(/lang-\w+/g, '');
            if (lang !== 'en') {
                document.body.classList.add('lang-' + lang);
            }
            
            // Hide all translations
            document.querySelectorAll('.translate, .translate-inline, .translate-flex').forEach(el => {
                el.classList.remove('active');
            });
            
            // Show current language translations
            document.querySelectorAll('[data-lang="' + lang + '"]').forEach(el => {
                el.classList.add('active');
            });
            
            // Update language buttons
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.lang === lang) {
                    btn.classList.add('active');
                }
            });
        }
        
        // Initialize language on page load
        document.addEventListener('DOMContentLoaded', function() {
            setLanguage(currentLang);
            
            // Add click handlers to language buttons
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    setLanguage(this.dataset.lang);
                });
            });
        });
        
        // Scroll Animation Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);
        
        // Observe all scroll reveal elements
        document.querySelectorAll('.scroll-reveal, .scroll-slide-left, .scroll-slide-right, .scroll-scale').forEach(el => {
            observer.observe(el);
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 8px 0 #000';
            } else {
                navbar.style.boxShadow = 'none';
            }
        });
        
        // Parallax effect for geometric shapes
        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.parallax');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 20;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                shape.style.transform = `translate(${x}px, ${y}px) rotate(${shape.dataset.rotation || 0}deg)`;
            });
        });
    </script>
</body>
</html>
