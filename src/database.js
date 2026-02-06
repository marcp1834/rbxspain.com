import { createPool } from 'mysql2/promise';

export const pool = createPool({
  host: 'localhost', 
  user: 'root',
  password: '', 
  database: 'info_clientes',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

console.log('Configuración de base de datos cargada.');
