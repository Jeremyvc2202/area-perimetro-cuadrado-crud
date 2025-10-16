<?php
// app/Models/Mensaje.php
class Mensaje {
    public static function all(): array {
        $pdo = Database::getConnection();
        $st = $pdo->query("SELECT * FROM cuadrado ORDER BY id DESC");
        return $st->fetchAll();
    }
    public static function find(int $id): ?array {
        $pdo = Database::getConnection();
        $st = $pdo->prepare("SELECT * FROM cuadrado WHERE id = ?");
        $st->execute([$id]);
        $r = $st->fetch(); return $r ?: null;
    }
    public static function create(array $d): int {
        $pdo = Database::getConnection();
        $st = $pdo->prepare("INSERT INTO cuadrado (lado, area, perimetro, fecha) VALUES (?, ?, ?, ?)");
        $st->execute([$d['lado'], $d['area'], $d['perimetro'], $d['fecha']]);
        return (int)$pdo->lastInsertId();
    }
    public static function updateById(int $id, array $d): bool {
        $pdo = Database::getConnection();
        $st = $pdo->prepare("UPDATE cuadrado SET lado=?, area=?, perimetro=?, fecha=? WHERE id=?");
        return $st->execute([$d['lado'], $d['area'], $d['perimetro'], $d['fecha'], $id]);
    }
    public static function deleteById(int $id): bool {
        $pdo = Database::getConnection();
        $st = $pdo->prepare("DELETE FROM cuadrado WHERE id=?");
        return $st->execute([$id]);
    }
}
