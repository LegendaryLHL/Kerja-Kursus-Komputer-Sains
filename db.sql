CREATE DATABASE pkj_kehadiran_db;

CREATE TABLE pekerja (
    id_pekerja INT(11) NOT NULL AUTO_INCREMENT,
    nama_pekerja VARCHAR(60) NOT NULL,
    katalaluan_pekerja VARCHAR(255) NOT NULL,
    no_kp_pekerja VARCHAR(12),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id_pekerja)
);

CREATE TABLE majikan (
    id_majikan INT(11) NOT NULL AUTO_INCREMENT,
    nama_majikan VARCHAR(60) NOT NULL,
    katalaluan_majikan VARCHAR(255) NOT NULL,
    no_kp_majikan VARCHAR(12),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id_majikan)
);

CREATE TABLE hari (
    id_hari INT(11) NOT NULL AUTO_INCREMENT,
    tarikh DATE NOT NULL DEFAULT CURRENT_DATE,
    adalah_hari_bekerja TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id_hari)
);

CREATE TABLE kehadiran (
    id_hari INT(11) NOT NULL,
    id_pekerja INT(11) NOT NULL,
    ada_hadir TINYINT(1) NOT NULL,
    masa_mula DATETIME NOT NULL DEFAULT CURRENT_TIME,
    masa_tamat DATETIME,

    PRIMARY KEY (id_hari, id_pekerja),

    FOREIGN KEY (id_hari)
    REFERENCES hari (id_hari)
    ON UPDATE CASCADE ON DELETE CASCADE,

    FOREIGN KEY (id_pekerja)
    REFERENCES pekerja (id_pekerja)
    ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE other (
    secret_key VARCHAR(255)
);
