@extends('layouts.user')

@section('title', 'About Us - Deniswears')

@section('content')

{{-- Hero Section --}}
<div class="relative bg-gradient-to-br from-gray-900 via-black to-gray-900 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="absolute w-full h-full" viewBox="0 0 1440 600" preserveAspectRatio="none">
            <path d="M0,300 Q360,100 720,300 T1440,300 L1440,600 L0,600 Z" fill="#ef4444"/>
            <path d="M0,400 Q360,200 720,400 T1440,400 L1440,600 L0,600 Z" fill="#dc2626"/>
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-7xl md:text-9xl font-black mb-6 leading-none" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
            ABOUT US
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            Streetwear Culture - Express Your Urban Identity
        </p>
    </div>
</div>

{{-- Story Section --}}
<div class="bg-black text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-red-500 font-bold uppercase tracking-wide text-sm mb-4 block">Our Story</span>
                <h2 class="text-5xl font-black mb-6" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                    BORN FROM THE<br>STREETS
                </h2>
                <p class="text-gray-400 mb-4 leading-relaxed">
                    Fashion Tanpa Harus Mahal
                    Berawal dari keresahan tentang sulitnya mencari outfit streetwear yang berkualitas namun tetap bersahabat dengan dompet mahasiswa, Deniswears lahir sebagai jawaban.
                    Kami percaya bahwa gaya hidup urban dan penampilan yang edgy adalah hak semua orang, bukan cuma mereka yang punya budget berlebih.

                </p>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Deniswears hadir untuk mengisi lemari anak kost dan kaum "online" dengan koleksi yang timeless, berani, dan yang paling penting: terjangkau
                </p>
                <div class="flex gap-4">
                    <div class="text-center">
                        <p class="text-4xl font-black text-red-500">4+</p>
                        <p class="text-sm text-gray-400">Tahun di Scene</p>
                    </div>
                    <div class="text-center border-l border-gray-800 pl-4">
                        <p class="text-4xl font-black text-red-500">10K+</p>
                        <p class="text-sm text-gray-400">Streetwear Fam</p>
                    </div>
                    <div class="text-center border-l border-gray-800 pl-4">
                        <p class="text-4xl font-black text-red-500">50+</p>
                        <p class="text-sm text-gray-400">Exclusive Drops</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400" 
                         alt="Streetwear Style 1"
                         class="w-full h-64 object-cover rounded-2xl shadow-xl">
                    <img src="https://images.unsplash.com/photo-1622445275463-afa2ab738c34?w=400" 
                         alt="Streetwear Style 2"
                         class="w-full h-64 object-cover rounded-2xl shadow-xl mt-8">
                    <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=400" 
                         alt="Streetwear Style 3"
                         class="w-full h-64 object-cover rounded-2xl shadow-xl -mt-8">
                    <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=400" 
                         alt="Streetwear Style 4"
                         class="w-full h-64 object-cover rounded-2xl shadow-xl">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Values Section --}}
<div class="bg-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-500 font-bold uppercase tracking-wide text-sm mb-4 block">Our Values</span>
            <h2 class="text-5xl font-black mb-4" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                WHY SHOP WITH US?
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Low Budget, High Impact - Simple & Fast - Modern Aesthetic
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Value 1 --}}
            <div class="bg-black rounded-2xl p-8 border border-gray-800 hover:border-red-500 transition group">
                <div class="w-16 h-16 bg-red-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Low Budget, High Impact</h3>
                <p class="text-gray-400 leading-relaxed">
                    Kami mengkurasi produk fashion kekinian dengan harga yang nggak bikin saldo ATM menangis di akhir bulan. Style premium, harga mahasiswa.
                </p>
            </div>

            {{-- Value 2 --}}
            <div class="bg-black rounded-2xl p-8 border border-gray-800 hover:border-red-500 transition group">
                <div class="w-16 h-16 bg-red-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Simple & Fast</h3>
                <p class="text-gray-400 leading-relaxed">
                    Website kami didesain khusus buat kamu yang sibuk. Navigasi yang mudah dan transaksi yang praktis bikin belanja jadi lebih efisien.
                </p>
            </div>

            {{-- Value 3 --}}
            <div class="bg-black rounded-2xl p-8 border border-gray-800 hover:border-red-500 transition group">
                <div class="w-16 h-16 bg-red-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Modern Aesthetic</h3>
                <p class="text-gray-400 leading-relaxed">
                    Dengan identitas warna Merah & Hitam, kami membawa semangat keberanian dan elegansi ke dalam setiap paket yang kamu terima.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Team Section --}}
<div class="bg-black text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-500 font-bold uppercase tracking-wide text-sm mb-4 block">Our Vision</span>
            <h2 class="text-5xl font-black mb-6" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                WHERE WE'RE HEADING
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto mb-12 text-lg leading-relaxed">
                Menjadi platform e-commerce fashion nomor satu bagi mahasiswa dan anak muda di Indonesia dengan menyediakan gaya streetwear yang inklusif, modern, dan paling mengerti kebutuhan kantong anak kost.
            </p>
        </div>

        <div class="text-center mb-16">
            <span class="text-red-500 font-bold uppercase tracking-wide text-sm mb-4 block">The Squad</span>
            <h2 class="text-5xl font-black mb-4" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                MEET THE CREW
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Tim kreatif yang breathe streetwear culture setiap hari
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            {{-- Team Member 1 --}}
            <div class="group">
                <div class="bg-gray-800 rounded-2xl overflow-hidden mb-4 relative h-80">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400" 
                         alt="Denis - Founder"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-lg">Denis Wijaya</p>
                            <p class="text-red-500 text-sm font-semibold">Founder & Creative Head</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Team Member 2 --}}
            <div class="group">
                <div class="bg-gray-800 rounded-2xl overflow-hidden mb-4 relative h-80">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400" 
                         alt="Sarah - Designer"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-lg">Sarah Chen</p>
                            <p class="text-red-500 text-sm font-semibold">Lead Designer</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Team Member 3 --}}
            <div class="group">
                <div class="bg-gray-800 rounded-2xl overflow-hidden mb-4 relative h-80">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400" 
                         alt="Mike - Art Director"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-lg">Mike Rodriguez</p>
                            <p class="text-red-500 text-sm font-semibold">Art Director</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Team Member 4 --}}
            <div class="group">
                <div class="bg-gray-800 rounded-2xl overflow-hidden mb-4 relative h-80">
                    <img src="https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?w=400" 
                         alt="Maya - Community Manager"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-lg">Maya Kusuma</p>
                            <p class="text-red-500 text-sm font-semibold">Community Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA Section --}}
<div class="bg-gradient-to-br from-red-500 to-red-700 text-white py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-5xl md:text-6xl font-black mb-6" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
            READY TO JOIN THE MOVEMENT?
        </h2>
        <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">
            Cop the latest drops dan jadi bagian dari streetwear community Indonesia
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('user.home') }}" 
               class="px-8 py-4 bg-white text-red-500 font-bold rounded-full hover:bg-gray-100 transition text-lg uppercase tracking-wide">
                Shop Now
            </a>
            <a href="#contact" 
               class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-red-500 transition text-lg uppercase tracking-wide">
                Hit Us Up
            </a>
        </div>
    </div>
</div>

{{-- Contact Section --}}
<div id="contact" class="bg-black text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <span class="text-red-500 font-bold uppercase tracking-wide text-sm mb-4 block">Get In Touch</span>
                <h2 class="text-5xl font-black mb-6" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                    HOLLA AT US
                </h2>
                <p class="text-gray-400 mb-8 leading-relaxed">
                    Got questions atau mau collab? DM us! We're always down untuk connect dengan streetwear enthusiasts. 
                    Response time kami cepat, janji!
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Email</p>
                            <p class="text-white font-semibold">info@deniswears.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Phone / WhatsApp</p>
                            <p class="text-white font-semibold">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Headquarters</p>
                            <p class="text-white font-semibold">Jl. Urban Street No. 88<br>Jakarta Selatan, Indonesia</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Instagram</p>
                            <p class="text-white font-semibold">@deniswears.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900 rounded-2xl p-8 border border-gray-800">
                <form class="space-y-6">
                    <div>
                        <label class="text-sm font-semibold text-gray-400 mb-2 block uppercase tracking-wide">Name</label>
                        <input type="text" 
                               placeholder="Your name"
                               class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 transition">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-400 mb-2 block uppercase tracking-wide">Email</label>
                        <input type="email" 
                               placeholder="your@email.com"
                               class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 transition">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-400 mb-2 block uppercase tracking-wide">Message</label>
                        <textarea rows="5" 
                                  placeholder="What's on your mind?"
                                  class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 transition resize-none"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-4 rounded-full transition flex items-center justify-center gap-2 uppercase tracking-wide">
                        Send Message
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection