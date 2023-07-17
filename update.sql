15/07/2023

ALTER TABLE `kategori`ADD COLUMN `notifikasi` TEXT NOT NULL AFTER `template_lulus`;
ALTER TABLE `kategori` ADD COLUMN `tampilkan_notifikasi` ENUM('Y','N') NOT NULL DEFAULT 'N' AFTER `notifikasi`;


CREATE TABLE `penerima_sebelumnya` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nik` VARCHAR(16) NOT NULL DEFAULT '0',
	`kk` VARCHAR(16) NOT NULL DEFAULT '0',
	`nama` VARCHAR(50) NOT NULL DEFAULT '0',
	`alamat` VARCHAR(150) NOT NULL DEFAULT '0',
	`kab_kota` VARCHAR(50) NOT NULL DEFAULT '0',
	`no_hp` VARCHAR(15) NOT NULL DEFAULT '0',
	`tahun` VARCHAR(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_0900_ai_ci'
;

ALTER TABLE `penerima_sebelumnya` ADD COLUMN `keterangan` VARCHAR(100) NULL DEFAULT NULL AFTER `tahun`;
ALTER TABLE `penerima_sebelumnya` CHANGE COLUMN `keterangan` `jenis_beasiswa` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci' AFTER `tahun`;
ALTER TABLE `penerima_sebelumnya`
	CHANGE COLUMN `kk` `kk` VARCHAR(16) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci' AFTER `nik`,
	CHANGE COLUMN `alamat` `alamat` VARCHAR(150) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci' AFTER `nama`,
	CHANGE COLUMN `kab_kota` `kab_kota` VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci' AFTER `alamat`,
	CHANGE COLUMN `no_hp` `no_hp` VARCHAR(15) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci' AFTER `kab_kota`,
	CHANGE COLUMN `tahun` `tahun` VARCHAR(4) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci' AFTER `no_hp`;

ALTER TABLE `penerima_sebelumnya`	ADD UNIQUE INDEX `nik` (`nik`);