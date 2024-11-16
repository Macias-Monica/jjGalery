CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('user', 'admin') DEFAULT 'user',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `images` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,  -- Relaciona la imagen con el usuario que la subió
  `filename` VARCHAR(255) NOT NULL,  -- Nombre del archivo de la imagen
  `description` TEXT,  -- Descripción de la imagen
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de subida
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de la última actualización
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)  -- Relaciona la imagen con el usuario
);
