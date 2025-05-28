

#Date 

## ✅ PHP Equivalent of JavaScript Date Functions

| JavaScript                     | PHP Equivalent                              | Description                                  |
|-------------------------------|---------------------------------------------|----------------------------------------------|
| `new Date()`                  | `new DateTime()`                            | Create a new date object                     |
| `getFullYear()`               | `$date->format('Y')`                        | Get the year                                 |
| `getMonth()`                  | `$date->format('m')`                        | Get the month (01–12)                        |
| `getDate()`                   | `$date->format('d')`                        | Get the day of the month                     |
| `getDay()`                    | `$date->format('w')`                        | Get the day of the week (0=Sunday, 6=Saturday) |
| `setFullYear()`               | `$date->setDate()` or `modify()`            | Set the year                                 |
| `setMonth()`                  | `$date->setDate()` or `modify()`            | Set the month                                |
| `setDate()`                   | `$date->setDate()`                          | Set the day of the month                     |

---

## 🧪 Example: Working with Dates in PHP

```php
<?php
// Create a new DateTime object for the current date/time
$date = new DateTime();

// Output basic info
echo "Current Date: " . $date->format('Y-m-d') . "<br>";
echo "Year: " . $date->format('Y') . "<br>";         // 2025
echo "Month: " . $date->format('m') . "<br>";        // 04
echo "Day of Month: " . $date->format('d') . "<br>"; // 05
echo "Day of Week: " . $date->format('w') . "<br>";  // 6 = Saturday

// Change date manually
$date->setDate(2023, 12, 25); // Year, Month, Day
echo "After setDate: " . $date->format('Y-m-d') . "<br>";

// Modify date using strings
$date->modify('+1 week');
echo "After +1 week: " . $date->format('Y-m-d') . "<br>";

$date->modify('-3 days');
echo "After -3 days: " . $date->format('Y-m-d') . "<br>";

// Format as readable string
echo "Formatted Date: " . $date->format('l, F j, Y') . "<br>";
?>
```

---

## 📌 Notes:

- `DateTime` is an **object-oriented class** in PHP.
- Use `->format('format_string')` to output the date in any format.
- You can also pass timezone as an argument:
  ```php
  $date = new DateTime('now', new DateTimeZone('Asia/Dubai'));
  ```

---

## 🧠 Common Date Format Codes

| Format Code | Meaning             | Example     |
|-------------|---------------------|-------------|
| `Y`         | Year (4 digits)     | 2025        |
| `y`         | Year (2 digits)     | 25          |
| `m`         | Month (01–12)       | 04          |
| `n`         | Month (no leading 0)| 4           |
| `F`         | Full month name     | April       |
| `M`         | Short month name    | Apr         |
| `d`         | Day of month        | 05          |
| `j`         | Day of month (no 0) | 5           |
| `l`         | Full weekday name   | Saturday    |
| `D`         | Short weekday name  | Sat         |
| `w`         | Day of week (0–6)   | 6           |

