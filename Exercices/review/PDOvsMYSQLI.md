## ✅ 1. **Database Connection**

### 🔸 PDO

```php
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "username", "password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

### 🔸 MySQLi OOP

```php
$conn = new mysqli("localhost", "username", "password", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```

---

## ✅ 2. **INSERT**

### 🔸 PDO

```php
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->execute(['John', 'john@example.com']);
```

### 🔸 MySQLi OOP

```php
$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);
$name = "John";
$email = "john@example.com";
$stmt->execute();
```

---

## ✅ 3. **UPDATE**

### 🔸 PDO

```php
$stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
$stmt->execute(['new@example.com', 1]);
```

### 🔸 MySQLi OOP

```php
$stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
$stmt->bind_param("si", $email, $id);
$email = "new@example.com";
$id = 1;
$stmt->execute();
```

---

## ✅ 4. **DELETE**

### 🔸 PDO

```php
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([1]);
```

### 🔸 MySQLi OOP

```php
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$id = 1;
$stmt->execute();
```

---

## ✅ 5. **SELECT + `foreach` loop**

### 🔸 PDO

```php
$stmt = $pdo->query("SELECT * FROM users");
foreach ($stmt as $row) {
    echo $row['name'] . "<br>";
}
```

### 🔸 MySQLi OOP

```php
$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
    echo $row['name'] . "<br>";
}
```

---

## ✅ 6. **Length of array / result set (`count`, `len`)**

### 🔸 Array length:

```php
$data = ['a', 'b', 'c'];
echo count($data);  // Output: 3
```

### 🔸 PDO Row count:

```php
$stmt = $pdo->query("SELECT * FROM users");
echo $stmt->rowCount();  // Only works reliably for DELETE/UPDATE
```

> ⚠️ For SELECT, better to fetch and count:

```php
$data = $stmt->fetchAll();
echo count($data);
```

### 🔸 MySQLi num rows:

```php
$result = $conn->query("SELECT * FROM users");
echo $result->num_rows;
```

---

## ✅ Bonus: Close Connection

```php
// PDO
$pdo = null;

// MySQLi
$conn->close();
```