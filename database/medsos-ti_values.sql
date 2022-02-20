/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.13-MariaDB : Database - medsos-ti
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`medsos-ti` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medsos-ti`;

/*Table structure for table `classroom` */

DROP TABLE IF EXISTS `classroom`;

CREATE TABLE `classroom` (
  `id_classroom` int(11) NOT NULL AUTO_INCREMENT,
  `nama_classroom` text,
  `keterangan` text,
  `classroom_cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_classroom`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `classroom` */

insert  into `classroom`(`id_classroom`,`nama_classroom`,`keterangan`,`classroom_cover`) values (1,'Rekayasa Perangkat Lunak (A)','Grup kelas Rekayasa Perangkat Lunak (A) untuk saling bertukar\r\ninformasi mengenai perkuliahan','S__6127721.jpg.320');
insert  into `classroom`(`id_classroom`,`nama_classroom`,`keterangan`,`classroom_cover`) values (2,'Interaksi Manusia Komputer (A)','Grup kelas Interaksi Manusia Komputer (A) untuk saling bertukar\r\ninformasi mengenai perkuliahan','4k-wallpapers-phone-Is-4K-Wallpaper.jpg.115');
insert  into `classroom`(`id_classroom`,`nama_classroom`,`keterangan`,`classroom_cover`) values (3,'Imaging System (B)','Grup kelas Imaging System (B) untuk saling bertukar informasi mengenai perkuliahan dan sebagainya.','fighter_jet.jpg.423');
insert  into `classroom`(`id_classroom`,`nama_classroom`,`keterangan`,`classroom_cover`) values (4,'Pemrograman Internet (E)','Grup kelas pemrograman internet (E) untuk mahasiswa saling membagikan informasi perkuliahan.','imk.jpg');
insert  into `classroom`(`id_classroom`,`nama_classroom`,`keterangan`,`classroom_cover`) values (5,'Pengantar Manajemen Bisnis (A)','Grup Pengantar Manajemen Bisnis','futuristic-tech-geometry-cyan-wallpaper-preview.jpg');

/*Table structure for table `kepanitiaan` */

DROP TABLE IF EXISTS `kepanitiaan`;

CREATE TABLE `kepanitiaan` (
  `id_kepanitiaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `head_kepanitiaan` text,
  `tahun_kepanitiaan` int(11) DEFAULT NULL,
  `val_kepanitiaan` text,
  PRIMARY KEY (`id_kepanitiaan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `kepanitiaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `kepanitiaan` */

insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (5,2,'ITCC',2020,'Sekretaris Inti II');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (6,2,'BAKSOS TI',2020,'Sekretaris Inti II');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (9,6,'SPORTI',2020,'Koordinator Sie Acara');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (10,6,'SPORTI',2019,'Anggota Sie Acara');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (11,2,'SEMNAS TI',2020,'Sekretaris Inti II');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (12,2,'ITCC',2019,'Anggota Sie Pemrograman');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (13,7,'ITCC',2019,'Anggota Sie Humas');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (14,1,'MUSANG HMTI',2020,'Anggota Sie Pubdok');
insert  into `kepanitiaan`(`id_kepanitiaan`,`id_user`,`head_kepanitiaan`,`tahun_kepanitiaan`,`val_kepanitiaan`) values (15,1,'ITCC',2019,'Anggota Sie Ide Bisnis');

/*Table structure for table `organisasi` */

DROP TABLE IF EXISTS `organisasi`;

CREATE TABLE `organisasi` (
  `id_organisasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `head_organisasi` text,
  `tahun_organisasi` int(11) DEFAULT NULL,
  `val_organisasi` text,
  PRIMARY KEY (`id_organisasi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `organisasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `organisasi` */

insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (5,2,'ETC',2020,'Bendahara');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (6,2,'HMTI',2020,'Anggota Divisi Pameran Ilmiah');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (8,1,'IMITEK',2021,'Kepala Bidang Divisi Media');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (9,2,'MAESTRO',2021,'Anggota Bidang Redaksi TJM');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (10,1,'IMITEK',2020,'Anggota Divisi Syiar');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (11,7,'FKMB UNUD',2020,'Anggota Bidang 2');
insert  into `organisasi`(`id_organisasi`,`id_user`,`head_organisasi`,`tahun_organisasi`,`val_organisasi`) values (13,6,'IMITEK',2019,'Anggota Divisi Media');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `post_content` varchar(255) DEFAULT NULL,
  `upload_image` varchar(255) DEFAULT NULL,
  `upload_docs` varchar(255) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (1,1,'Halo civitas TI Unud, selamat datang di ConnecTI','582b61535597d60833350cf501d37247.jpeg.61',NULL,'2020-12-29 03:20:36');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (2,2,'ITCC Yes We Can!','233099.jpg.83',NULL,'2020-12-29 03:21:13');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (3,6,'Forza Teknik!! #WWCD','1568985521701.jpg.57','Jadwal UAS Ganjil 20202021 TI Unud.pdf','2020-12-29 03:23:51');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (4,7,'Semoga perkuliahan offline segera bisa dilaksanakan! #edisi_kangen_kampus_bukit','S__6127721.jpg.87',NULL,'2020-12-29 03:24:48');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (5,7,'Selamat Natal dan Tahun Baru untuk seluruh civitas TI Unud :)',NULL,NULL,'2020-12-29 03:27:35');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (6,6,'Ayo teman-teman dukung kontingan Fakultas Teknik di Gor Ngurah Rai jam 5 sore nanti! \r\n#ForzaTeknik',NULL,NULL,'2020-12-29 03:33:28');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (7,1,'Selamat datang di ConnecTI',NULL,NULL,'2020-12-29 11:18:43');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (8,1,NULL,'233099.jpg.5',NULL,'2020-12-29 11:19:00');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (9,1,NULL,NULL,'Jadwal UAS Ganjil 20202021 TI Unud.pdf','2020-12-29 11:19:11');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (10,1,'Kampus TI Unud Jimbaran','582b61535597d60833350cf501d37247.jpeg.88',NULL,'2020-12-29 11:44:59');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (11,1,'Mohon info perkuliahan semester genap',NULL,NULL,'2020-12-29 11:51:37');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (12,1,NULL,NULL,'Daftar Calon Petani dan Calon Lahan.xlsx','2020-12-29 11:53:44');
insert  into `posts`(`id_post`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (13,1,'Selamat untuk teman-teman yang bergabung di TI Unud 2019!',NULL,'Pengumuman SBMPTN 2019 Gabung.pdf','2020-12-29 11:56:01');

/*Table structure for table `posts_classroom` */

DROP TABLE IF EXISTS `posts_classroom`;

CREATE TABLE `posts_classroom` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_classroom` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `post_content` text,
  `upload_image` varchar(255) DEFAULT NULL,
  `upload_docs` varchar(255) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  KEY `id_classroom` (`id_classroom`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `posts_classroom_ibfk_3` FOREIGN KEY (`id_classroom`) REFERENCES `classroom` (`id_classroom`),
  CONSTRAINT `posts_classroom_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `posts_classroom` */

insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (1,3,1,'Ini materi pertemuan pertama',NULL,'pertemuan 1.ppt','2020-12-29 03:19:50');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (2,2,2,'Info workshop Web Application with Laravel, bisa join ya di workshop tecart teman-teman','233612.jpg.89',NULL,'2020-12-29 03:22:01');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (3,1,6,'Info tugas project ya','363043.jpg.75',NULL,'2020-12-29 03:24:05');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (4,1,7,'Materi tadi pagi ya',NULL,'1. pertemuan 1_rpl (1).ppt','2020-12-29 03:28:03');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (5,2,1,'Mohon dipersiapkan masing-masing prototype tiap kelompok ya',NULL,NULL,'2020-12-29 03:28:49');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (6,3,2,'Izin share jurnal ya, berkaitan dengan materi minggu ini',NULL,'1144-3126-1-PB.pdf','2020-12-29 03:30:13');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (7,1,2,'Semangat guys demo aplikasinya yaa^^',NULL,NULL,'2020-12-29 03:31:30');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (8,3,6,'Jangan lupa pengumpulan ppt dan laporan materi presentasi segera diselesaikan sebelum UAS!',NULL,NULL,'2020-12-29 03:34:12');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (9,2,7,'Materi presentasi tadi pagi ya',NULL,'Presentation 1.pptx','2020-12-29 03:35:12');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (10,3,2,NULL,NULL,'Presentasi Imaging Fix Kelompok 7.pdf','2020-12-29 10:33:12');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (11,3,2,NULL,NULL,'Absensi Imaging System B.xlsx','2020-12-29 10:35:52');
insert  into `posts_classroom`(`id_post`,`id_classroom`,`id_user`,`post_content`,`upload_image`,`upload_docs`,`post_date`) values (12,1,1,NULL,NULL,'DATA THL NIK BERMASALAH.xlsx','2020-12-29 11:20:59');

/*Table structure for table `prestasi` */

DROP TABLE IF EXISTS `prestasi`;

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `head_prestasi` text,
  `tahun_prestasi` int(11) DEFAULT NULL,
  `val_prestasi` text,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `prestasi` */

insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (5,2,'SPORTI',2019,'Juara I Futsal Putri');
insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (7,1,'UJF CUP',2019,'Juara II Counter Strike: Global Offensive');
insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (8,1,'UJF CUP',2020,'Juara I Pro Evolution Soccer 2020');
insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (9,6,'SPORTI',2019,'Juara I Futsal Putri');
insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (10,7,'GAMER VILLAGE',2019,'Juara II PUBG Solo Match');
insert  into `prestasi`(`id_prestasi`,`id_user`,`head_prestasi`,`tahun_prestasi`,`val_prestasi`) values (11,2,'PMCC Region WIT',2019,'Top #3 Fragger Ladies ');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` text,
  `l_name` text,
  `u_name` text,
  `u_pass` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_image` varchar(255) DEFAULT NULL,
  `u_cover` varchar(255) DEFAULT NULL,
  `u_konsentrasi` varchar(255) DEFAULT NULL,
  `u_prodi` varchar(255) DEFAULT NULL,
  `u_angkatan` varchar(11) DEFAULT NULL,
  `u_reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_user` text,
  `posts` text,
  `posts_class` text,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (1,'Muhammad','Syakurrahman','1905551077','ae00675dbb120be4c29de169bef7757b','thisiscyber13@gmail.com','ITCC_1.jpg.945','devoxid_022.jpg.895','Manajemen Keamanan dan Jaringan','Teknologi Informasi','2019','2020-12-29 11:36:27','verified','yes','yes');
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (2,'Vidya','Chandradev','1905551067','ae00675dbb120be4c29de169bef7757b','vidyachandradev@gmail.com','Foto_201228.jpg.197','PicsArt_09-18-12.22.14.jpg.336','Teknologi Cerdas','Teknologi Informasi','2019','2020-12-28 16:51:36','verified','yes','yes');
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (3,'Bagus','Krishnanda','1905551078','ae00675dbb120be4c29de169bef7757b','baguskrishnanda@gmail.com','default.jpg','default.jpg',NULL,'Teknologi Informasi',NULL,'2020-12-27 16:33:39','verified','yes',NULL);
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (5,'Oki Chandra','Oktavian','1905551071','ae00675dbb120be4c29de169bef7757b','okichandra@gmail.com','default.jpg','default.jpg',NULL,'Teknologi Informasi',NULL,'2020-12-12 16:25:45','verified','no',NULL);
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (6,'Naila','Rofifatul Hidayah','1905551035','ae00675dbb120be4c29de169bef7757b','nailarh@gmail.com','S__7086566.jpg.299','1565381497959.jpg.25','Manajemen Bisnis','Teknologi Informasi','2019','2020-12-28 16:46:34','verified','yes','yes');
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (7,'Adrian','Arta Chandra','1905551068','ae00675dbb120be4c29de169bef7757b','adrianartac@gmail.com','IMG_6007.jpg.837','2a5e11514f1ce16fff1c2a5e93a79f5b.jpg.199','Manajemen Data dan Informasi','Teknologi Informasi','2019','2020-12-28 17:00:44','verified','yes','yes');
insert  into `users`(`id_user`,`f_name`,`l_name`,`u_name`,`u_pass`,`u_email`,`u_image`,`u_cover`,`u_konsentrasi`,`u_prodi`,`u_angkatan`,`u_reg_date`,`status_user`,`posts`,`posts_class`) values (8,'Prabhaisvari','Sadhaka','1905551044','25d55ad283aa400af464c76d713c07ad','jungzzz00@gmail.com','default.jpg','default.jpg',NULL,'Teknologi Informasi',NULL,'2020-12-29 09:44:50','verified','no',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
