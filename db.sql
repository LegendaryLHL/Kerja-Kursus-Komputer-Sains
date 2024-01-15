CREATE TABLE pekerja (
    id_pekerja INT(11) NOT NULL AUTO_INCREMENT,
    nama_pekerja VARCHAR(30) NOT NULL,
    katalaluan_pekerja VARCHAR(255) NOT NULL,
    no_kp_pekerja INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id_pekerja)
)