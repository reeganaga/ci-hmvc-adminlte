
<?php
$user = $this->ion_auth->user()->row();
//var_dump($this->ion_auth->is_admin());
$active_admin = $user->active_admin;
?>
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <?php if ($active_admin == 0) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">belum aktif</div>

                <b>Silakan lengkapi terlebih dahulu halaman (isian) profile anda, dan pengelola akan memverifikasi data anda</b>
            </div>
        </div>
    <?php } else { ?>
        <!-- <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        -->

        <div class="row">
            <div class="col-md-12">
                <center><b>Sistem Informasi Pengelolaan dan Pengembangan UMKM (SIPPUM)</b></center>
                <br/>
            </div>

            <div class="col-md-12">
                Tujuan disusunnya sistem ini adalah untuk dapat menjadi panduan bagi para pemangku kepentingan yang terkait dengan pengelolaan dan pengembangan Usaha Mikro, Kecil dan Menengah (UMKM). Sistem ini menyajikan instrumen yang dapat menjadi alat ukur untuk mengevaluasi kinerja UMKM dan Tata Kelola BUMDes.
                <br/>
                Di Indonesia UMKM mempunyai peran strategis diantaranya penyerapan tenaga kerja, pengolahan sumber daya lokal, pemberian layanan ekonomi yang luas kepada masyarakat, dan proses pemerataan serta peningkatan pendapatan masyarakat. UMKM memiliki potensi untuk menjadi pondasi pembangunan ekonomi Indonesia, hal ini dapat ditunjukkan dengan bertahannya UMKM pada saat terjadinya krisis ekonomi nasional tahun 1998.
                <!-- /.box -->
                <br/>
                Dalam konteks pembangunan wilayah, UMKM juga telah terbukti memberikan banyak kontribusi bagi perekonomian di Indonesia. Paradigma baru dalam pembangunan ekonomi daerah yang dikenal sebagai Modern Regional Policy diyakini akan memberikan manfaat yang lebih besar dan berkelanjutan.
                <br/>
                Tantangan yang dihadapi oleh UMKM di Era Pasar Bebas dan Pasar Disruptif adalah kualitas dan daya saing produk. Untuk itu perlu dilakukan upaya meningkatkan kualitas produk, akses pasar, dan, pemanfaatan teknologi yang tepat agar memberikan kemanfaatan lebih besar dan dapat dirasakan masyarakat sekitarnya. Beberapa aspek inovasi yang diperlukan bagi UMKM dalam mengembangkan produknya adalah : (1) inovasi dalam bidang teknologi proses produksi, (2) inovasi dalam bidang pemasaran dan jejaring, serta (3) inovasi dalam bidang desain produk. Dalam hal ini UMKM harus mempunyai jiwa technopreneurship. Dengan penerapan inovasi teknologi tersebut diharapkan UMKM mampu bersaing baik di tingkat lokal maupun pasar global. Dalam menerapkan inovasi dan teknologi diperlukan dukungan dari aspek regulasi, keuangan, kapasitas sumber daya manusia dan teknologi.

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">

            <div class="col-md-12">
                Perkembangan UMKM tersebut terhambat oleh adanya kendala seputar : (1) lemahnya kualitas sumberdaya manusia, (2) rendahnya mutu produk, (3) terbatasnya akses permodalan, (4) terbatasnya pemasaran dan jejaring, serta (5) kurangnya inovasi dan teknologi. Pemecahan terhadap permasalahan ini dilakukan salah satunya dengan mengukur kinerja UMKM. Direktorat Pengabdian kepada Masyarakat (DPKM) Universitas Gadjah Mada telah menyusun instrumen untuk dapat mengukur kinerja UMKM tersebut dengan Key Performance Indicators (KPIs) UMKM.
                <br/>
                KPIs merupakan sebuah pengukuran kuantitatif dalam evaluasi kinerja organisasi yang memiliki berbagai perspektif dan menjadi acuan pencapaian target organisasi. DPKM Universitas Gadjah Mada telah mampu menyelesaikan Instrumen KPIs UMKM, yang terdiri atas sebelas indikator UMKM yang meliputi : (1) Produksi, (2) Good Manufacturing Practice (GMP), (3) Pengendalian Mutu (Quality Control), (4) Branding, Packaging, Labelling dan Kekayaan Intelektual, (5) Pemasaran, (6) Manajemen Keuangan, (7) Permodalan dan Literasi, (8) Kelembagaan, (9) Sumber Daya Manusia, (10) Karakter, dan (11) Perizinan, serta satu aspek pengukuran Tata Kelola BUMDes.
                Semoga bermanfaat.

            </div>

        </div>
        <!-- /.row -->
    <?php } ?>


</section>
<!-- /.content -->
