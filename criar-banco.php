<?php
// -------------------------------------------
// 1. INFORMAÇÕES DE CONEXÃO
//    Altere estas variáveis com as suas credenciais.
// -------------------------------------------
$host = 'localhost';
$port = '5432';
$dbname = 'db-aluraplay';     // <-- Substitua pelo nome do seu banco
$user = 'admin';     // <-- Substitua pelo seu usuário
$password = 'admin';   // <-- Substitua pela sua senha

// -------------------------------------------
// 2. COMANDO SQL PARA CRIAR A TABELA
//    Usamos "CREATE TABLE IF NOT EXISTS" para não gerar erro se a tabela já existir.
//    Usamos "SERIAL" em vez de "INTEGER" para o ID, pois ele cria uma chave primária auto-incrementável no PostgreSQL.
// -------------------------------------------
$sql = "
    CREATE TABLE IF NOT EXISTS videos (
        id SERIAL PRIMARY KEY,
        url TEXT NOT NULL,
        titulo TEXT NOT NULL
    );
";

try {
    // -------------------------------------------
    // 3. CONEXÃO COM O BANCO DE DADOS
    // -------------------------------------------
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Garante que erros do PDO sejam tratados como exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // -------------------------------------------
    // 4. EXECUÇÃO DO COMANDO
    //    O método exec() é usado para comandos que não retornam resultados (como CREATE, INSERT, UPDATE, DELETE).
    // -------------------------------------------
    $pdo->exec($sql);

    echo "Tabela 'videos' criada com sucesso (ou já existia)!";

} catch (PDOException $e) {
    // -------------------------------------------
    // 5. TRATAMENTO DE ERRO
    //    Se algo der errado, a mensagem de erro será exibida.
    // -------------------------------------------
    die("Erro ao conectar ou ao criar a tabela: " . $e->getMessage());
}
?>