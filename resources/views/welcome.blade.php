<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MYCAREERCOACH') }} - Unlocking Academic Potential</title>

    <!-- Tailwind Config & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .hero-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .blob {
            filter: blur(80px);
            z-index: -1;
            position: absolute;
            border-radius: 50%;
            opacity: 0.8;
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-gray-100 text-gray-900 overflow-x-hidden selection:bg-primary-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed top-0 inset-x-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-primary shadow-lg shadow-primary-500/30 group-hover:scale-105 transition-transform">
                    <i class="fas fa-university text-white text-lg"></i>
                </div>
                <span class="text-2xl font-heading font-bold text-gray-900 tracking-tight">MYCAREER<span
                        class="text-primary-500">COACH</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
                <a href="#features" class="hover:text-primary-600 transition-colors">Features</a>
                <a href="#how-it-works" class="hover:text-primary-600 transition-colors">How it Works</a>
                <a href="#success-stories" class="hover:text-primary-600 transition-colors">Success Stories</a>
            </div>

            <div class="flex items-center gap-4 border-l border-gray-200 pl-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-premium">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-medium text-gray-700 hover:text-primary-600 transition-colors hidden sm:block">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-premium py-2 px-6 shadow-sm">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative pt-36 pb-24 lg:pt-52 lg:pb-40 overflow-hidden bg-gradient-to-br from-slate-50 via-primary-50 to-primary-100 hero-pattern">
        <!-- Blobs -->
        <div class="blob bg-primary-400 w-96 h-96 top-0 right-0 -translate-y-1/2 translate-x-1/3"></div>
        <div class="blob bg-accent-300 w-80 h-80 bottom-0 left-0 translate-y-1/3 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8">
                <!-- Text Content -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 text-primary-600 font-medium text-sm mb-6 border border-primary-100 shadow-sm">
                        <i class="fas fa-sparkles"></i> CLARITY FOR YOUR FUTURE ACADEMIC JOURNEY
                    </div>
                    <h1 class="font-heading font-extrabold text-5xl lg:text-7xl text-gray-900 leading-tight mb-6">
                        Stop Guessing. Discover Your <span class="text-gradient">True Potential</span>
                    </h1>
                    <p
                        class="text-xl lg:text-2xl text-gray-700 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Choosing a career path is overwhelming. You don't have to do it completely alone. Our
                        intelligent platform understands your unique strengths and guides you toward the perfect
                        university course.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                            class="btn-premium text-lg w-full sm:w-auto px-8 py-4 shadow-xl shadow-primary-500/20">
                            Start Free Assessment
                        </a>
                        <a href="#how-it-works"
                            class="flex items-center justify-center gap-2 bg-white text-gray-800 font-medium text-lg w-full sm:w-auto px-8 py-4 rounded-full border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all shadow-sm">
                            Learn More <i class="fas fa-play-circle text-gray-400"></i>
                        </a>
                    </div>

                    <div
                        class="mt-12 flex items-center justify-center lg:justify-start gap-10 border-t border-gray-200 pt-8">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                            <span class="text-gray-800 font-semibold text-base">Data-Driven</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                            <span class="text-gray-800 font-semibold text-base">Expert Counsellors</span>
                        </div>
                    </div>
                </div>

                <!-- Visual Content -->
                <div class="lg:w-1/2 w-full mt-12 lg:mt-0 relative flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-lg lg:max-w-xl">

                        <!-- Floating Accent Element -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-accent-500 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-pulse"
                            style="animation-duration: 6s;"></div>

                        <!-- Glass Panel Stats 1 -->
                        <div
                            class="absolute -top-8 -left-12 z-30 glass-panel p-5 rounded-2xl shadow-xl flex items-center gap-4 hover:-translate-y-2 transition-transform duration-300 border border-white/50 bg-white/90 backdrop-blur-md">
                            <div
                                class="w-12 h-12 rounded-full bg-accent-50 text-accent-500 flex items-center justify-center text-xl">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div>
                                <h6 class="font-bold text-gray-900 leading-none">Smart Matching</h6>
                                <p class="text-xs text-gray-500 mt-1">AI-Powered Logic</p>
                            </div>
                        </div>

                        <!-- Glass Panel Stats 2 -->
                        <div
                            class="absolute -bottom-10 -right-6 z-30 glass-panel px-8 py-6 rounded-3xl shadow-2xl border border-white/50 bg-white/90 backdrop-blur-md text-center transform hover:-translate-y-2 transition-transform duration-300">
                            <div class="font-heading font-extrabold text-5xl text-primary-600 mb-1">98%</div>
                            <p class="text-gray-500 font-semibold text-sm uppercase tracking-widest text-accent-500">
                                Accuracy</p>
                        </div>

                        <!-- Main Image Layout -->
                        <div class="relative z-10 w-full h-[500px] lg:h-[600px]">
                            <!-- Main Large Image -->
                            <div
                                class="absolute inset-0 rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white bg-gray-100 transform -rotate-2 hover:rotate-0 transition-transform duration-500">
                                <img src="{{ asset('images/globe-round.jpg') }}" alt="Students collaborating"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-primary-900/10 mix-blend-overlay"></div>
                            </div>

                            <!-- Overlapping Small Image -->
                            <div
                                class="absolute -bottom-4 -left-8 w-48 h-48 rounded-[2rem] overflow-hidden shadow-2xl border-8 border-white hidden md:block transform rotate-6 hover:rotate-0 transition-transform duration-500 z-20">
                                <img src="{{ asset('images/group-circle.jpg') }}" alt="Focus group"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="font-heading font-extrabold text-4xl md:text-5xl text-gray-900 mb-5">Comprehensive Career
                    Support</h2>
                <p class="text-xl md:text-2xl text-gray-600 font-medium">Everything you need to make informed decisions
                    about your academic and
                    professional future.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="glass-panel p-8 bg-white hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-900 mb-3">System Recommendations</h4>
                    <p class="text-gray-600 leading-relaxed">Our advanced algorithm analyzes your profile to suggest
                        careers that perfectly align with your strengths.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="glass-panel p-8 bg-white hover:-translate-y-2 transition-transform duration-300 transform md:translate-y-4">
                    <div
                        class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-900 mb-3">Aptitude Testing</h4>
                    <p class="text-gray-600 leading-relaxed">Scientific assessments covering mathematics, logical
                        reasoning, and domain-specific knowledge.</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-panel p-8 bg-white hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-compass"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-900 mb-3">Career Guidance</h4>
                    <p class="text-gray-600 leading-relaxed">Explore an extensive database of modern careers, required
                        skills, and salary expectations.</p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="glass-panel p-8 bg-white hover:-translate-y-2 transition-transform duration-300 transform md:translate-y-4">
                    <div
                        class="w-14 h-14 bg-cyan-50 text-cyan-500 rounded-2xl flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-900 mb-3">Expert Counselling</h4>
                    <p class="text-gray-600 leading-relaxed">Book 1-on-1 sessions with professional university
                        counsellors to discuss your assessment results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Steps text -->
                <div class="lg:w-1/2">
                    <h2 class="font-heading font-bold text-4xl text-gray-900 mb-6">Your Journey to Success</h2>
                    <p class="text-xl text-gray-600 mb-12">Four simple steps to discover your ideal career path and
                        connect with academic advisors.</p>

                    <div class="space-y-10">
                        <div class="flex gap-6">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-xl shadow-md">
                                1</div>
                            <div>
                                <h5 class="text-xl font-bold text-gray-900 mb-2">Create an Account</h5>
                                <p class="text-gray-600">Build your profile with your interests and academic background
                                    within our secure platform.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-xl shadow-md">
                                2</div>
                            <div>
                                <h5 class="text-xl font-bold text-gray-900 mb-2">Take Assessment</h5>
                                <p class="text-gray-600">Complete our scientifically validated aptitude tests directly
                                    on your dashboard.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-xl shadow-md">
                                3</div>
                            <div>
                                <h5 class="text-xl font-bold text-gray-900 mb-2">Get System Recommendations</h5>
                                <p class="text-gray-600">View your personalized career reports and target matching
                                    scores generated instantly.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-primary text-white flex items-center justify-center font-bold text-xl shadow-md">
                                4</div>
                            <div>
                                <h5 class="text-xl font-bold text-gray-900 mb-2">Meet a Counsellor</h5>
                                <p class="text-gray-600">Book a session with human experts to finalize your academic
                                    plan seamlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visuals grid Collage -->
                <div class="lg:w-1/2 w-full relative min-h-[600px] hidden md:block">
                    <!-- Accent Background Decoration -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] rounded-full bg-slate-100 z-0">
                    </div>

                    <div class="relative z-10 w-full h-full">
                        <!-- Image 1 (Top Right) -->
                        <img src="{{ asset('images/counsellor-student.jpg') }}" alt="Counsellor providing guidance"
                            class="absolute top-0 right-0 w-2/3 h-[350px] object-cover rounded-[2rem] shadow-2xl border-8 border-white transform hover:scale-105 transition-transform duration-500">

                        <!-- Image 2 (Bottom Left overlapping) -->
                        <img src="{{ asset('images/hands-globe.jpg') }}" alt="Students united"
                            class="absolute bottom-12 left-0 w-[55%] h-[280px] object-cover rounded-[2rem] shadow-2xl border-8 border-white transform -rotate-3 hover:rotate-0 transition-transform duration-500 z-20">

                        <!-- Image 3 (Bottom Right overlapping) -->
                        <img src="{{ asset('images/group-circle.jpg') }}" alt="Group session"
                            class="absolute -bottom-6 right-8 w-40 h-40 object-cover rounded-full shadow-2xl border-6 border-accent-100 transform rotate-6 hover:rotate-0 transition-transform duration-500 z-30">

                        <!-- Floating Stat Badge -->
                        <div
                            class="absolute top-1/3 -left-8 bg-white p-4 rounded-2xl shadow-xl z-30 flex items-center gap-3 border border-gray-100">
                            <div
                                class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Certified</p>
                                <p class="font-bold text-gray-900">Expert Coaches</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile fallback visual -->
                <div class="lg:hidden w-full mt-10">
                    <img src="{{ asset('images/counsellor-student.jpg') }}" alt="Counsellor Guidance"
                        class="w-full h-64 object-cover rounded-2xl shadow-lg border-4 border-white">
                </div>
            </div>
        </div>
    </section>

    <!-- Impact / Why Us Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden border-t border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="font-heading font-extrabold text-4xl text-gray-900 mb-6">We Understand The Struggle</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-16 leading-relaxed">
                Millions of students graduate with degrees they regret. We built <span
                    class="font-bold text-gray-800">MYCAREERCOACH</span>
                with the bravery to tell you the truth about your aptitudes and the empathy to guide you through the
                noise.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-gray-200">
                <div class="px-4">
                    <h3 class="text-5xl font-extrabold text-primary-600 mb-2">10k+</h3>
                    <p class="text-gray-500 font-medium">Students Guided</p>
                </div>
                <div class="px-4">
                    <h3 class="text-5xl font-extrabold text-emerald-500 mb-2">95%</h3>
                    <p class="text-gray-500 font-medium">Course Satisfaction</p>
                </div>
                <div class="px-4">
                    <h3 class="text-5xl font-extrabold text-amber-500 mb-2">50+</h3>
                    <p class="text-gray-500 font-medium">Career Profiles</p>
                </div>
                <div class="px-4">
                    <h3 class="text-5xl font-extrabold text-purple-600 mb-2">100%</h3>
                    <p class="text-gray-500 font-medium">Empathetic Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="success-stories" class="py-24 bg-primary-900 text-white relative overflow-hidden">
        <!-- Blobs -->
        <div class="blob bg-primary-700 w-96 h-96 top-0 left-0 -translate-y-1/2 -translate-x-1/2"></div>
        <div class="blob bg-accent-600 w-80 h-80 bottom-0 right-0 translate-y-1/3 translate-x-1/3 opacity-30"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h2 class="font-heading font-extrabold text-4xl mb-4 text-white">Trusted by Thousands of Students</h2>
            <p class="text-primary-200 text-xl mb-16 max-w-2xl mx-auto">Real stories from individuals who found their
                passion with MYCAREERCOACH.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div
                    class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10 text-left hover:-translate-y-2 transition-transform">
                    <div class="text-amber-400 text-lg mb-6 flex gap-1">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-300 italic mb-8">"The system accurately pinpointed my strengths in Data Science
                        before I even knew I liked it. After talking to the counsellor over the app, I switched majors
                        happily."</p>
                    <div class="flex items-center gap-4 border-t border-white/10 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Jenkins&background=3b82f6&color=fff&size=96"
                            alt="Sarah Jenkins" class="w-12 h-12 rounded-full object-cover border-2 border-white/20">
                        <div>
                            <h6 class="font-bold text-white">Sarah Jenkins</h6>
                            <p class="text-gray-400 text-sm">Computer Science</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div
                    class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10 text-left hover:-translate-y-2 transition-transform transform md:-translate-y-4">
                    <div class="text-amber-400 text-lg mb-6 flex gap-1">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-300 italic mb-8">"I was lost regarding what to study. The aptitude test exposed
                        my organizational skills, and a career in Business Admin has been immensely rewarding since
                        then."</p>
                    <div class="flex items-center gap-4 border-t border-white/10 pt-6">
                        <img src="https://ui-avatars.com/api/?name=David+Chen&background=10b981&color=fff&size=96"
                            alt="David Chen" class="w-12 h-12 rounded-full object-cover border-2 border-white/20">
                        <div>
                            <h6 class="font-bold text-white">David Chen</h6>
                            <p class="text-gray-400 text-sm">Business Administration</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div
                    class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10 text-left hover:-translate-y-2 transition-transform">
                    <div class="text-amber-400 text-lg mb-6 flex gap-1">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-300 italic mb-8">"Booking an appointment through the platform is seamless. It
                        bridged the gap between raw data results from the assessment and actual emotional career
                        guidance."</p>
                    <div class="flex items-center gap-4 border-t border-white/10 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Amanda+Osei&background=f59e0b&color=fff&size=96"
                            alt="Amanda Osei" class="w-12 h-12 rounded-full object-cover border-2 border-white/20">
                        <div>
                            <h6 class="font-bold text-white">Amanda Osei</h6>
                            <p class="text-gray-400 text-sm">Media & Arts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="py-24 bg-white" x-data="{ activeAccordion: 1 }">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-heading font-extrabold text-4xl text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600">We understand you have questions. We have honest answers.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300">
                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1"
                        class="w-full flex items-center justify-between p-6 bg-gray-50 hover:bg-gray-100 transition-colors text-left focus:outline-none">
                        <span class="font-bold text-lg text-gray-900">What if I completely fail the aptitude
                            test?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"
                            :class="{'transform rotate-180': activeAccordion === 1}"></i>
                    </button>
                    <div x-show="activeAccordion === 1" x-collapse>
                        <div class="p-6 bg-white text-gray-600 leading-relaxed border-t border-gray-100">
                            There is no "failing" our tests. The assessments are strictly designed to discover your
                            natural inclinations. A low score in Mathematics simply means we will redirect you toward
                            creative, artistic, or social fields where you will inevitably thrive. We celebrate your
                            true strengths instead of punishing weaknesses.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300">
                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2"
                        class="w-full flex items-center justify-between p-6 bg-gray-50 hover:bg-gray-100 transition-colors text-left focus:outline-none">
                        <span class="font-bold text-lg text-gray-900">How long does the whole process take?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"
                            :class="{'transform rotate-180': activeAccordion === 2}"></i>
                    </button>
                    <div x-show="activeAccordion === 2" x-collapse>
                        <div class="p-6 bg-white text-gray-600 leading-relaxed border-t border-gray-100">
                            You can set up an account and complete the core aptitude tests in under 45 minutes. System
                            recommendations are generated instantly. Connecting with a human counsellor depends on their
                            schedule, but sessions are usually booked within a few days. We value your time.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300">
                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3"
                        class="w-full flex items-center justify-between p-6 bg-gray-50 hover:bg-gray-100 transition-colors text-left focus:outline-none">
                        <span class="font-bold text-lg text-gray-900">Do I really need to speak to a counsellor if the
                            system gives me recommendations?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"
                            :class="{'transform rotate-180': activeAccordion === 3}"></i>
                    </button>
                    <div x-show="activeAccordion === 3" x-collapse>
                        <div class="p-6 bg-white text-gray-600 leading-relaxed border-t border-gray-100">
                            While our data-driven recommendations are highly accurate (98%), choosing a career is an
                            emotional and deeply human decision. Our counsellors help contextualize your results with
                            your family expectations, financial goals, and personal fears. We strongly believe human
                            empathy is the most vital step of your journey.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="py-24 relative overflow-hidden bg-primary-900">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
        </div>
        <div class="blob bg-primary-500 w-96 h-96 top-0 right-0 -translate-y-1/2 translate-x-1/2"></div>

        <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
            <h2 class="font-heading font-extrabold text-4xl md:text-5xl text-white mb-6">Ready to Conquer Your Future?
            </h2>
            <p class="text-primary-100 text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                Take the brave first step. Say goodbye to confusion and let's uncover the university degree you're truly
                meant to study.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-4 bg-white text-primary-900 font-bold rounded-full shadow-xl hover:scale-105 transition-transform text-lg">
                    Join for Free Today
                </a>
                <a href="#how-it-works"
                    class="w-full sm:w-auto px-8 py-4 bg-transparent border border-primary-400 text-white font-bold rounded-full hover:bg-primary-800 transition-colors text-lg">
                    See How It Works
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-white pt-20 pb-10 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Info -->
                <div class="lg:col-span-1">
                    <a href="/" class="flex items-center gap-2 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-primary shadow-md">
                            <i class="fas fa-university text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-heading font-bold text-gray-900">MYCAREER<span
                                class="text-primary-500">COACH</span></span>
                    </a>
                    <p class="text-gray-500 mb-6 leading-relaxed text-sm">Empowering students to make data-driven
                        decisions about their academic futures using our decision support system.</p>
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 flex items-center justify-center hover:bg-primary-50 hover:text-primary-500 transition-colors border border-gray-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 flex items-center justify-center hover:bg-primary-50 hover:text-primary-500 transition-colors border border-gray-200">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 flex items-center justify-center hover:bg-primary-50 hover:text-primary-500 transition-colors border border-gray-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h5 class="text-gray-900 font-bold mb-6 uppercase tracking-wider text-sm">Platform</h5>
                    <ul class="space-y-4">
                        <li><a href="#"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Home</a></li>
                        <li><a href="#features"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Features</a>
                        </li>
                        <li><a href="#how-it-works"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">How it
                                Works</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Log in</a>
                        </li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h5 class="text-gray-900 font-bold mb-6 uppercase tracking-wider text-sm">Resources</h5>
                    <ul class="space-y-4">
                        <li><a href="#"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Careers
                                Database</a></li>
                        <li><a href="#"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Testing
                                Guidelines</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Help
                                Center</a></li>
                        <li><a href="#"
                                class="text-gray-500 hover:text-primary-600 transition-colors font-medium">Privacy
                                Policy</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h5 class="text-gray-900 font-bold mb-6 uppercase tracking-wider text-sm">Get in Touch</h5>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-gray-500 font-medium">
                            <i class="fas fa-user text-primary-500"></i> Nkengfack Hebert
                        </li>
                        <li class="flex items-center gap-3 text-gray-500 font-medium">
                            <i class="fas fa-envelope text-primary-500"></i> nkengfackhebert7@gmail.com
                        </li>
                        <li class="flex items-center gap-3 text-gray-500 font-medium">
                            <i class="fab fa-whatsapp text-emerald-500 text-lg"></i> <a
                                href="https://wa.me/237652442022" class="hover:text-emerald-600 transition-colors">+237
                                652 44 20 22</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm font-medium">&copy; {{ date('Y') }} MYCAREERCOACH. All rights reserved.
                </p>
                <div class="flex gap-6 text-sm font-medium text-gray-400">
                    <a href="#" class="hover:text-primary-600 transition-colors">Terms</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>