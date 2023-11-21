SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `mahasiswa` (
    `nama` varchar(100) NOT NULL,
    `nim` varchar(50) NOT NULL,
    `prodi` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
ALTER TABLE `mahasiswa`
ADD PRIMARY KEY (`nim`);
COMMIT;