# API Documentation - Tes Magang PT Aksamedia Mulia Digital

## Base URL

```
http://localhost:8000/api
```

## Authentication

Menggunakan Laravel Sanctum dengan Bearer Token.

## Endpoints

### 1. Login (Tugas 1)

**Endpoint:** `POST /login`
**Method:** POST
**Headers:**

-   Content-Type: application/json

**Request Body:**

```json
{
    "username": "admin",
    "password": "pastibisa"
}
```

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Login berhasil",
    "data": {
        "token": "1|abc123...",
        "admin": {
            "id": "uuid-admin",
            "name": "Administrator",
            "username": "admin",
            "phone": "081234567890",
            "email": "admin@aksamedia.co.id"
        }
    }
}
```

**Response Error (401):**

```json
{
    "status": "error",
    "message": "Username atau password salah"
}
```

---

### 2. Get All Divisions (Tugas 2)

**Endpoint:** `GET /divisions`
**Method:** GET
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: application/json

**Query Parameters (Optional):**

-   `name`: Filter berdasarkan nama divisi

**Example:**

```
GET /divisions?name=Backend
```

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Data divisi berhasil diambil",
    "data": {
        "divisions": [
            {
                "id": "uuid-divisi",
                "name": "Backend"
            }
        ]
    },
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 6,
        "from": 1,
        "to": 6,
        "prev_page_url": null,
        "next_page_url": null
    }
}
```

---

### 3. Get All Employees (Tugas 3)

**Endpoint:** `GET /employees`
**Method:** GET
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: application/json

**Query Parameters (Optional):**

-   `name`: Filter berdasarkan nama karyawan
-   `division_id`: Filter berdasarkan UUID divisi

**Example:**

```
GET /employees?name=John&division_id=uuid-divisi
```

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Data karyawan berhasil diambil",
    "data": {
        "employees": [
            {
                "id": "uuid-employee",
                "image": "http://localhost:8000/storage/employees/photo.jpg",
                "name": "John Doe",
                "phone": "081234567890",
                "division": {
                    "id": "uuid-divisi",
                    "name": "Backend"
                },
                "position": "Senior Developer"
            }
        ]
    },
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 1,
        "from": 1,
        "to": 1,
        "prev_page_url": null,
        "next_page_url": null
    }
}
```

---

### 4. Create Employee (Tugas 4)

**Endpoint:** `POST /employees`
**Method:** POST
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: multipart/form-data

**Request Body (Form Data):**

-   `image`: File (optional) - Format: jpeg, png, jpg, gif. Max: 2MB
-   `name`: String (required) - Nama karyawan
-   `phone`: String (required) - No telepon
-   `division`: UUID (required) - UUID divisi
-   `position`: String (required) - Jabatan

**Response Success (201):**

```json
{
    "status": "success",
    "message": "Karyawan berhasil ditambahkan"
}
```

**Response Error (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": ["Nama karyawan wajib diisi"],
        "division": ["Divisi tidak valid"]
    }
}
```

---

### 5. Update Employee (Tugas 5)

**Endpoint:** `PUT /employees/{uuid}`
**Method:** PUT
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: multipart/form-data

**Note:** Untuk Laravel, gunakan `_method=PUT` di form data jika menggunakan POST request dengan file upload.

**Request Body (Form Data):**

-   `_method`: PUT (jika menggunakan POST)
-   `image`: File (optional) - Format: jpeg, png, jpg, gif. Max: 2MB
-   `name`: String (required) - Nama karyawan
-   `phone`: String (required) - No telepon
-   `division`: UUID (required) - UUID divisi
-   `position`: String (required) - Jabatan

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Karyawan berhasil diupdate"
}
```

---

### 6. Delete Employee (Tugas 6)

**Endpoint:** `DELETE /employees/{uuid}`
**Method:** DELETE
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: application/json

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Karyawan berhasil dihapus"
}
```

**Response Error (404):**

```json
{
    "message": "No query results for model [App\\Models\\Employee] uuid"
}
```

---

### 7. Logout (Tugas 7)

**Endpoint:** `POST /logout`
**Method:** POST
**Headers:**

-   Authorization: Bearer {token}
-   Content-Type: application/json

**Response Success (200):**

```json
{
    "status": "success",
    "message": "Logout berhasil"
}
```

---

## Testing Sequence

1. **Login** untuk mendapatkan token
2. **Test Get Divisions** dengan token
3. **Test Get Employees** dengan token
4. **Test Create Employee** dengan token dan data lengkap
5. **Test Update Employee** dengan token dan UUID karyawan
6. **Test Delete Employee** dengan token dan UUID karyawan
7. **Test Logout** dengan token

## Default Login Credentials

-   Username: `admin`
-   Password: `pastibisa`

## Data Divisions (dari seeder)

-   Mobile Apps
-   QA
-   Full Stack
-   Backend
-   Frontend
-   UI/UX Designer

## Data Employees (dari seeder)

-   **Akbar Ryyan Saputra** - Backend Developer (Division: Backend)
-   **Siti Nurhaliza** - Frontend Developer (Division: Frontend)
-   **Budi Santoso** - Mobile Developer (Division: Mobile Apps)
-   **Andi Setiawan** - QA Engineer (Division: QA)
-   **Maya Sari** - UI/UX Designer (Division: UI/UX Designer)
-   **Rizky Pratama** - Full Stack Developer (Division: Full Stack)

## PowerShell Testing Examples

### Login:

```powershell
Invoke-RestMethod -Uri "http://localhost:8000/api/login" -Method POST -Headers @{"Content-Type"="application/json"} -Body '{"username":"admin","password":"pastibisa"}'
```

### Get Divisions:

```powershell
Invoke-RestMethod -Uri "http://localhost:8000/api/divisions" -Method GET -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"}
```

### Get Employees:

```powershell
Invoke-RestMethod -Uri "http://localhost:8000/api/employees" -Method GET -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"}
```

### Get Employees with Filter:

```powershell
# Filter by name
Invoke-RestMethod -Uri "http://localhost:8000/api/employees?name=Akbar" -Method GET -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"}

# Filter by division_id (use actual UUID from divisions endpoint)
Invoke-RestMethod -Uri "http://localhost:8000/api/employees?division_id=01985727-bcb7-72cf-bfce-a57924fd4f9b" -Method GET -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"}
```

### Create Employee (simple text fields):

```powershell
$body = @{
    name = "John Doe"
    phone = "081234567899"
    division = "01985727-bcb7-72cf-bfce-a57924fd4f9b"  # Backend division UUID
    position = "Senior Developer"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/employees" -Method POST -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"} -Body $body
```

### Logout:

```powershell
Invoke-RestMethod -Uri "http://localhost:8000/api/logout" -Method POST -Headers @{"Authorization"="Bearer YOUR_TOKEN";"Content-Type"="application/json"}
```

## Quick Test Commands

### Get Fresh Token:

```powershell
$loginResponse = Invoke-RestMethod -Uri "http://localhost:8000/api/login" -Method POST -Headers @{"Content-Type"="application/json"} -Body '{"username":"admin","password":"pastibisa"}'
$token = $loginResponse.data.token
Write-Host "Token: $token"
```

### Use Token in Subsequent Requests:

```powershell
$headers = @{"Authorization"="Bearer $token";"Content-Type"="application/json"}
Invoke-RestMethod -Uri "http://localhost:8000/api/employees" -Method GET -Headers $headers
```

## Error Responses

### Authentication Required (401):

```json
{
    "message": "Unauthenticated."
}
```

### Already Logged In (403):

```json
{
    "status": "error",
    "message": "Anda sudah login, logout terlebih dahulu"
}
```

### Validation Error (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": ["Error message"]
    }
}
```
