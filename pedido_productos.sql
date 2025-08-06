-- Tabla para guardar los productos de cada pedido
CREATE TABLE pedido_productos (
  id INT NOT NULL AUTO_INCREMENT,
  pedido_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT DEFAULT 1,
  precio_unitario DECIMAL(10,2) DEFAULT NULL,
  talla VARCHAR(50) DEFAULT NULL,
  color VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
  FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
