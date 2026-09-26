CREATE DATABASE crud_mahasiswa;
USE crud_mahasiswa;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    fakultas VARCHAR(100) NOT NULL,
    program_studi VARCHAR(100) NOT NULL
);



