CREATE TABLE clicks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(45),
    datahora DATETIME,
    geo VARCHAR(255),
    os VARCHAR(100),
    dispositivo VARCHAR(100),
    browser TEXT,
    pagina VARCHAR(100),
    acessos INT,
    online INT,
    tempo BIGINT,
    status VARCHAR(50)
);

-- Criar tabela 'acessos'
CREATE TABLE acessos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    login VARCHAR(255),
    senha VARCHAR(255),
    ip VARCHAR(45),
    datahora DATETIME,
    geo VARCHAR(255),
    browser TEXT,
    os VARCHAR(100),
    access_token VARCHAR(255),
    refresh_token VARCHAR(255),
    pagina VARCHAR(100)
);