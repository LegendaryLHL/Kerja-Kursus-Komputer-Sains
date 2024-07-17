CREATE DATABASE pkj_kehadiran_db;

CREATE TABLE pengguna (
    id_pengguna INT(11) NOT NULL AUTO_INCREMENT,
    nama_pengguna VARCHAR(60) NOT NULL,
    katalaluan_pengguna VARCHAR(255) NOT NULL,
    no_kp_pengguna VARCHAR(12),
    adalah_majikan TINYINT(1) NOT NULL DEFAULT 0,
    masa_dibuat DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id_pengguna)
);

CREATE TABLE hari (
    id_hari INT(11) NOT NULL AUTO_INCREMENT,
    tarikh DATE NOT NULL DEFAULT CURRENT_DATE,
    adalah_hari_bekerja TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id_hari)
);

CREATE TABLE kehadiran (
    id_hari INT(11) NOT NULL,
    id_pengguna INT(11) NOT NULL,
    ada_hadir TINYINT(1) NOT NULL,
    masa_mula DATETIME NOT NULL DEFAULT CURRENT_TIME,
    masa_tamat DATETIME,

    PRIMARY KEY (id_hari, id_pengguna),

    FOREIGN KEY (id_hari)
    REFERENCES hari (id_hari)
    ON UPDATE CASCADE ON DELETE CASCADE,

    FOREIGN KEY (id_pengguna)
    REFERENCES pengguna (id_pengguna)
    ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE kunci_kehadiran (
    kunci VARCHAR(255) UNIQUE NOT NULL,
    id_pengguna INT(11) NOT NULL,
    FOREIGN KEY (id_pengguna)
    REFERENCES pengguna (id_pengguna)
);
