CREATE TABLE `uzivatel`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` CHAR(255) NOT NULL,
    `heslo` CHAR(255) NOT NULL,
    `jmeno` CHAR(255) NOT NULL,
    `prijmeni` CHAR(255) NOT NULL,
    `email` CHAR(255) NOT NULL,
    `id_role` CHAR(255) NOT NULL
);
ALTER TABLE
    `uzivatel` ADD PRIMARY KEY `uzivatel_id_primary`(`id`);
CREATE TABLE `clanek`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nazev` CHAR(255) NOT NULL,
    `datum` DATE NOT NULL,
    `tema` CHAR(255) NOT NULL,
    `stav` CHAR(255) NOT NULL,
    `soubor` BINARY(16) NOT NULL,
    `spoluautori` CHAR(255) NOT NULL
);
ALTER TABLE
    `clanek` ADD PRIMARY KEY `clanek_id_primary`(`id`);
CREATE TABLE `uziv_clanek`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_autor` INT NOT NULL,
    `id_clanek` INT NOT NULL
);
ALTER TABLE
    `uziv_clanek` ADD PRIMARY KEY `uziv_clanek_id_primary`(`id`);
CREATE TABLE `posudek`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_uzivatel` INT NOT NULL,
    `id_clanek` INT NOT NULL,
    `text` CHAR(255) NOT NULL
);
ALTER TABLE
    `posudek` ADD PRIMARY KEY `posudek_id_primary`(`id`);
CREATE TABLE `role`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nazev` CHAR(255) NOT NULL,
    `kod` CHAR(255) NOT NULL
);
ALTER TABLE
    `role` ADD PRIMARY KEY `role_id_primary`(`id`);
ALTER TABLE
    `uziv_clanek` ADD CONSTRAINT `uziv_clanek_id_autor_foreign` FOREIGN KEY(`id_autor`) REFERENCES `uzivatel`(`id`);
ALTER TABLE
    `uzivatel` ADD CONSTRAINT `uzivatel_id_role_foreign` FOREIGN KEY(`id_role`) REFERENCES `role`(`id`);
ALTER TABLE
    `uziv_clanek` ADD CONSTRAINT `uziv_clanek_id_clanek_foreign` FOREIGN KEY(`id_clanek`) REFERENCES `clanek`(`id`);
ALTER TABLE
    `posudek` ADD CONSTRAINT `posudek_id_uzivatel_foreign` FOREIGN KEY(`id_uzivatel`) REFERENCES `uzivatel`(`id`);
ALTER TABLE
    `posudek` ADD CONSTRAINT `posudek_id_clanek_foreign` FOREIGN KEY(`id_clanek`) REFERENCES `clanek`(`id`);