<x-layouts.app title="Data Kependudukan - Desa Bantengputih"
    description="Dapatkan informasi lengkap tentang data kependudukan di Desa Bantengputih"
    keywords="data kependudukan, statistik desa, bantengputih">

    <x-slot name="head">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>

    <section class="bg-gradient-to-r from-primary to-accent py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Data Kependudukan
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Informasi demografis dan statistik kependudukan Desa Bantengputih
                berdasarkan data terbaru tahun 2024
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-users text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">1,526</h3>
                    <p class="text-blue-100">Total Penduduk</p>
                </div>
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-male text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">687</h3>
                    <p class="text-green-100">Laki-laki (45.0%)</p>
                </div>
                <div
                    class="bg-gradient-to-br from-pink-500 to-pink-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-female text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">839</h3>
                    <p class="text-pink-100">Perempuan (55.0%)</p>
                </div>
            </div>

            <!-- Age Distribution Table -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">
                    <i class="fas fa-chart-bar text-primary mr-3"></i>Distribusi
                    Penduduk Berdasarkan Usia
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Kelompok Usia</th>
                                <th class="py-3 px-4 text-center">Laki-laki</th>
                                <th class="py-3 px-4 text-center">Perempuan</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">
                                    Persentase
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">1</td>
                                <td class="py-3 px-4">0 - 4</td>
                                <td class="py-3 px-4 text-center">33</td>
                                <td class="py-3 px-4 text-center">36</td>
                                <td class="py-3 px-4 text-center font-semibold">69</td>
                                <td class="py-3 px-4 text-center">4,52%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">2</td>
                                <td class="py-3 px-4">5 - 9</td>
                                <td class="py-3 px-4 text-center">32</td>
                                <td class="py-3 px-4 text-center">39</td>
                                <td class="py-3 px-4 text-center font-semibold">71</td>
                                <td class="py-3 px-4 text-center">4,65%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">3</td>
                                <td class="py-3 px-4">10 - 14</td>
                                <td class="py-3 px-4 text-center">39</td>
                                <td class="py-3 px-4 text-center">63</td>
                                <td class="py-3 px-4 text-center font-semibold">102</td>
                                <td class="py-3 px-4 text-center">6,68%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">4</td>
                                <td class="py-3 px-4">15 - 19</td>
                                <td class="py-3 px-4 text-center">25</td>
                                <td class="py-3 px-4 text-center">37</td>
                                <td class="py-3 px-4 text-center font-semibold">62</td>
                                <td class="py-3 px-4 text-center">4,06%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">5</td>
                                <td class="py-3 px-4">20 - 24</td>
                                <td class="py-3 px-4 text-center">63</td>
                                <td class="py-3 px-4 text-center">86</td>
                                <td class="py-3 px-4 text-center font-semibold">149</td>
                                <td class="py-3 px-4 text-center">9,81%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">6</td>
                                <td class="py-3 px-4">25 - 29</td>
                                <td class="py-3 px-4 text-center">68</td>
                                <td class="py-3 px-4 text-center">95</td>
                                <td class="py-3 px-4 text-center font-semibold">163</td>
                                <td class="py-3 px-4 text-center">10,72%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">7</td>
                                <td class="py-3 px-4">30 - 34</td>
                                <td class="py-3 px-4 text-center">62</td>
                                <td class="py-3 px-4 text-center">86</td>
                                <td class="py-3 px-4 text-center font-semibold">148</td>
                                <td class="py-3 px-4 text-center">9,73%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">8</td>
                                <td class="py-3 px-4">35 - 39</td>
                                <td class="py-3 px-4 text-center">59</td>
                                <td class="py-3 px-4 text-center">80</td>
                                <td class="py-3 px-4 text-center font-semibold">139</td>
                                <td class="py-3 px-4 text-center">9,10%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">9</td>
                                <td class="py-3 px-4">40 - 44</td>
                                <td class="py-3 px-4 text-center">62</td>
                                <td class="py-3 px-4 text-center">82</td>
                                <td class="py-3 px-4 text-center font-semibold">144</td>
                                <td class="py-3 px-4 text-center">9,45%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">10</td>
                                <td class="py-3 px-4">45 - 49</td>
                                <td class="py-3 px-4 text-center">45</td>
                                <td class="py-3 px-4 text-center">53</td>
                                <td class="py-3 px-4 text-center font-semibold">98</td>
                                <td class="py-3 px-4 text-center">6,35%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">11</td>
                                <td class="py-3 px-4">50 - 54</td>
                                <td class="py-3 px-4 text-center">42</td>
                                <td class="py-3 px-4 text-center">47</td>
                                <td class="py-3 px-4 text-center font-semibold">89</td>
                                <td class="py-3 px-4 text-center">5,82%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">12</td>
                                <td class="py-3 px-4">54 - 59</td>
                                <td class="py-3 px-4 text-center">36</td>
                                <td class="py-3 px-4 text-center">37</td>
                                <td class="py-3 px-4 text-center font-semibold">73</td>
                                <td class="py-3 px-4 text-center">4,75%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">13</td>
                                <td class="py-3 px-4">60 - 64</td>
                                <td class="py-3 px-4 text-center">35</td>
                                <td class="py-3 px-4 text-center">35</td>
                                <td class="py-3 px-4 text-center font-semibold">70</td>
                                <td class="py-3 px-4 text-center">4,60%</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">14</td>
                                <td class="py-3 px-4">70+</td>
                                <td class="py-3 px-4 text-center">71</td>
                                <td class="py-3 px-4 text-center">81</td>
                                <td class="py-3 px-4 text-center font-semibold">152</td>
                                <td class="py-3 px-4 text-center">9,96%</td>
                            </tr>
                            <tr class="bg-primary text-white font-bold">
                                <td class="py-3 px-4 rounded-bl-lg" colspan="2">JUMLAH</td>
                                <td class="py-3 px-4 text-center">687</td>
                                <td class="py-3 px-4 text-center">839</td>
                                <td class="py-3 px-4 text-center">1,526</td>
                                <td class="py-3 px-4 text-center rounded-br-lg">100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Age Distribution Chart -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">
                    <i class="fas fa-chart-pie text-primary mr-3"></i>Grafik
                    Distribusi Usia
                </h3>
                <div class="max-w-2xl mx-auto">
                    <canvas id="ageChart" width="400" height="400"></canvas>
                </div>
            </div>

            <!-- Workforce Data -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">
                    <i class="fas fa-briefcase text-primary mr-3"></i>Data Tenaga
                    Kerja Tahun 2024
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-accent text-white">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Tingkatan Penduduk</th>
                                <th class="py-3 px-4 text-center">Laki-laki</th>
                                <th class="py-3 px-4 text-center">Perempuan</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">1</td>
                                <td class="py-3 px-4">Penduduk usia 18-56 tahun</td>
                                <td class="py-3 px-4 text-center">401</td>
                                <td class="py-3 px-4 text-center">529</td>
                                <td class="py-3 px-4 text-center font-semibold">930</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">2</td>
                                <td class="py-3 px-4">
                                    Penduduk usia 18-56 tahun yang bekerja
                                </td>
                                <td class="py-3 px-4 text-center">338</td>
                                <td class="py-3 px-4 text-center">491</td>
                                <td class="py-3 px-4 text-center font-semibold">829</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">3</td>
                                <td class="py-3 px-4">
                                    Penduduk usia 18-56 tahun yang belum/tidak bekerja
                                </td>
                                <td class="py-3 px-4 text-center">63</td>
                                <td class="py-3 px-4 text-center">38</td>
                                <td class="py-3 px-4 text-center font-semibold">101</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">4</td>
                                <td class="py-3 px-4">Penduduk usia 0-6 tahun</td>
                                <td class="py-3 px-4 text-center">58</td>
                                <td class="py-3 px-4 text-center">53</td>
                                <td class="py-3 px-4 text-center font-semibold">111</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">5</td>
                                <td class="py-3 px-4">
                                    Penduduk masih sekolah usia 7-18 tahun
                                </td>
                                <td class="py-3 px-4 text-center">86</td>
                                <td class="py-3 px-4 text-center">104</td>
                                <td class="py-3 px-4 text-center font-semibold">190</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">6</td>
                                <td class="py-3 px-4">Penduduk usia 56 tahun ke atas</td>
                                <td class="py-3 px-4 text-center">142</td>
                                <td class="py-3 px-4 text-center">153</td>
                                <td class="py-3 px-4 text-center font-semibold">295</td>
                            </tr>
                            <tr class="bg-accent text-white font-bold">
                                <td class="py-3 px-4 rounded-bl-lg" colspan="2">
                                    Jumlah Total Penduduk
                                </td>
                                <td class="py-3 px-4 text-center">687</td>
                                <td class="py-3 px-4 text-center">839</td>
                                <td class="py-3 px-4 text-center rounded-br-lg">1,526</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Education Level -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-secondary mb-6 text-center">
                        <i class="fas fa-graduation-cap text-primary mr-3"></i>Tingkat
                        Pendidikan
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-blue-500 text-white">
                                    <th class="py-2 px-3 text-left rounded-tl-lg">No</th>
                                    <th class="py-2 px-3 text-left">Tingkat Pendidikan</th>
                                    <th class="py-2 px-3 text-center">L</th>
                                    <th class="py-2 px-3 text-center">P</th>
                                    <th class="py-2 px-3 text-center rounded-tr-lg">
                                        Jumlah
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-3 font-semibold">1</td>
                                    <td class="py-2 px-3">Tidak Tamat SD</td>
                                    <td class="py-2 px-3 text-center">21</td>
                                    <td class="py-2 px-3 text-center">48</td>
                                    <td class="py-2 px-3 text-center font-semibold">69</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-3 font-semibold">2</td>
                                    <td class="py-2 px-3">Tamat SD</td>
                                    <td class="py-2 px-3 text-center">422</td>
                                    <td class="py-2 px-3 text-center">529</td>
                                    <td class="py-2 px-3 text-center font-semibold">951</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-3 font-semibold">3</td>
                                    <td class="py-2 px-3">Tidak Tamat SLTP</td>
                                    <td class="py-2 px-3 text-center">96</td>
                                    <td class="py-2 px-3 text-center">141</td>
                                    <td class="py-2 px-3 text-center font-semibold">237</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-3 font-semibold">4</td>
                                    <td class="py-2 px-3">Tamat SLTP</td>
                                    <td class="py-2 px-3 text-center">103</td>
                                    <td class="py-2 px-3 text-center">99</td>
                                    <td class="py-2 px-3 text-center font-semibold">202</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="py-2 px-3 font-semibold">5</td>
                                    <td class="py-2 px-3">Tamat Akademi/PT</td>
                                    <td class="py-2 px-3 text-center">45</td>
                                    <td class="py-2 px-3 text-center">22</td>
                                    <td class="py-2 px-3 text-center font-semibold">67</td>
                                </tr>
                                <tr class="bg-blue-500 text-white font-bold">
                                    <td class="py-2 px-3 rounded-bl-lg" colspan="2">
                                        JUMLAH
                                    </td>
                                    <td class="py-2 px-3 text-center">687</td>
                                    <td class="py-2 px-3 text-center">839</td>
                                    <td class="py-2 px-3 text-center rounded-br-lg">1,526</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-secondary mb-6 text-center">
                        <i class="fas fa-chart-doughnut text-primary mr-3"></i>Grafik
                        Pendidikan
                    </h3>
                    <canvas id="educationChart" width="300" height="300"></canvas>
                </div>
            </div>

            <!-- Economic Conditions -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">
                    <i class="fas fa-chart-line text-primary mr-3"></i>Kondisi Ekonomi
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-semibold text-secondary mb-6">
                            Mata Pencaharian
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                                <span class="font-medium">Petani</span>
                                <span class="text-green-600 font-bold">42%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <span class="font-medium">Sektor Swasta</span>
                                <span class="text-blue-600 font-bold">5%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                                <span class="font-medium">Buruh Tani</span>
                                <span class="text-yellow-600 font-bold">0.17%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <span class="font-medium">Lainnya</span>
                                <span class="text-gray-600 font-bold">52.83%</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-secondary mb-6">
                            Peternakan
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-orange-50 rounded">
                                <span>Peternak Ayam Kampung</span>
                                <span class="font-bold text-orange-600">750 orang</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-yellow-50 rounded">
                                <span>Peternak Itik</span>
                                <span class="font-bold text-yellow-600">25 orang</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded">
                                <span>Peternak Kambing</span>
                                <span class="font-bold text-red-600">16 orang</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-brown-50 rounded">
                                <span>Peternak Sapi</span>
                                <span class="font-bold text-brown-600">15 orang</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded">
                                <span>Peternak Ayam Broiler</span>
                                <span class="font-bold text-green-600">2 orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Economic Institutions -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">
                    <i class="fas fa-building text-primary mr-3"></i>Lembaga
                    Perekonomian
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-green-50 p-6 rounded-lg border border-green-200 text-center">
                        <i class="fas fa-leaf text-3xl text-green-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">Kelompok Tani</h4>
                        <p class="text-2xl font-bold text-green-600">3</p>
                        <p class="text-sm text-gray-600">Kelompok</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 text-center">
                        <i class="fas fa-fish text-3xl text-blue-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">
                            Pembudidaya Ikan
                        </h4>
                        <p class="text-2xl font-bold text-blue-600">5</p>
                        <p class="text-sm text-gray-600">Kelompok</p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200 text-center">
                        <i class="fas fa-store text-3xl text-purple-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">UMKM</h4>
                        <p class="text-2xl font-bold text-purple-600">1</p>
                        <p class="text-sm text-gray-600">Kelompok</p>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 text-center">
                        <i class="fas fa-handshake text-3xl text-yellow-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">BUM-Desa</h4>
                        <p class="text-2xl font-bold text-yellow-600">1</p>
                        <p class="text-sm text-gray-600">Unit</p>
                    </div>
                    <div class="bg-red-50 p-6 rounded-lg border border-red-200 text-center">
                        <i class="fas fa-piggy-bank text-3xl text-red-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">Simpan Pinjam</h4>
                        <p class="text-2xl font-bold text-red-600">1</p>
                        <p class="text-sm text-gray-600">Unit (Kopwan)</p>
                    </div>
                    <div class="bg-pink-50 p-6 rounded-lg border border-pink-200 text-center">
                        <i class="fas fa-users text-3xl text-pink-600 mb-4"></i>
                        <h4 class="font-semibold text-secondary mb-2">
                            Kelompok Perempuan
                        </h4>
                        <p class="text-2xl font-bold text-pink-600">9</p>
                        <p class="text-sm text-gray-600">Kelompok (Dasa Wisma)</p>
                    </div>
                </div>

                <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-secondary mb-4">
                        Dalam Perencanaan:
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-shopping-cart text-primary mr-3"></i>
                            <span class="font-medium">Pasar Desa</span>
                        </div>
                        <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-map-marked-alt text-primary mr-3"></i>
                            <span class="font-medium">Desa Wisata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Age Distribution Chart
            const ageCtx = document.getElementById("ageChart").getContext("2d");
            new Chart(ageCtx, {
                type: "pie",
                data: {
                    labels: ["0-14", "15-29", "30-44", "45-59", "60+"],
                    datasets: [{
                        data: [242, 374, 431, 260, 222],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#9966FF",
                        ],
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });

            // Education Chart
            const eduCtx = document.getElementById("educationChart").getContext("2d");
            new Chart(eduCtx, {
                type: "doughnut",
                data: {
                    labels: [
                        "Tidak Tamat SD",
                        "Tamat SD",
                        "Tidak Tamat SLTP",
                        "Tamat SLTP",
                        "Tamat Akademi/PT",
                    ],
                    datasets: [{
                        data: [69, 951, 237, 202, 67],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#9966FF",
                        ],
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });

            // Mobile menu functionality
            document.querySelectorAll(".mobile-dropdown-btn").forEach((btn) => {
                btn.addEventListener("click", function() {
                    const content = this.nextElementSibling;
                    content.classList.toggle("hidden");
                    this.querySelector("i").classList.toggle("rotate-180");
                });
            });

            document
                .getElementById("mobile-menu-button")
                .addEventListener("click", function() {
                    document.getElementById("mobile-menu").classList.remove("hidden");
                });

            document
                .getElementById("mobile-menu-close")
                .addEventListener("click", function() {
                    document.getElementById("mobile-menu").classList.add("hidden");
                });
        </script>
    @endpush
</x-layouts.app>
