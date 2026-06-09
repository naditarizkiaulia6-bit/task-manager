# Task Manager API Documentation

## Base URL
```
http://localhost:8000
```

## Authentication
Saat ini, API tidak memerlukan autentikasi. Untuk production, tambahkan Laravel Sanctum atau JWT.

---

## Endpoints

### 1. Get All Tasks (Kanban Board)

**Endpoint**
```
GET /tasks
```

**Response**
```json
{
  "tasksByStatus": {
    "todo": [
      {
        "id": 1,
        "title": "Design Homepage",
        "description": "Create homepage design mockup",
        "category": "design",
        "priority": "high",
        "status": "todo",
        "due_date": "2024-12-31",
        "assignee": "John Doe",
        "progress": 0,
        "created_at": "2024-01-01T00:00:00",
        "updated_at": "2024-01-01T00:00:00"
      }
    ],
    "progress": [...],
    "review": [...],
    "done": [...]
  },
  "stats": {
    "total": 10,
    "inProgress": 3,
    "completed": 2,
    "highPriority": 4
  }
}
```

---

### 2. Create New Task

**Endpoint**
```
POST /tasks
```

**Request Headers**
```
Content-Type: application/json
Accept: application/json
```

**Request Body**
```json
{
  "title": "Design Homepage",
  "description": "Create homepage design mockup",
  "category": "design",
  "priority": "high",
  "due_date": "2024-12-31",
  "assignee": "John Doe"
}
```

**Required Fields**
- `title` (string, max: 255)
- `category` (string, enum: design|dev|bug|research)
- `priority` (string, enum: low|medium|high)

**Optional Fields**
- `description` (string, max: 1000)
- `due_date` (date)
- `assignee` (string, max: 255)

**Success Response (302)**
```
Redirect to /tasks with flash message
Location: /tasks?success=Tugas%20berhasil%20ditambahkan!
```

**Validation Error (422)**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."],
    "category": ["The category field is invalid."]
  }
}
```

**cURL Example**
```bash
curl -X POST http://localhost:8000/tasks \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Design UI Mockups",
    "description": "Create mockups for admin dashboard",
    "category": "design",
    "priority": "high",
    "due_date": "2024-12-25",
    "assignee": "Jane Smith"
  }'
```

---

### 3. Update Task

**Endpoint**
```
PUT /tasks/{id}
POST /tasks/{id} (with _method=PUT for form)
```

**Request Body (All fields optional)**
```json
{
  "status": "progress",
  "priority": "medium",
  "progress": 50
}
```

**Updateable Fields**
- `status` (enum: todo|progress|review|done)
- `priority` (enum: low|medium|high)
- `progress` (integer, 0-100)

**Success Response (302)**
```
Redirect to /tasks with flash message
```

**Not Found (404)**
```json
{
  "message": "Task not found"
}
```

**cURL Example**
```bash
curl -X PUT http://localhost:8000/tasks/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "status": "progress",
    "progress": 75
  }'
```

---

### 4. Delete Task

**Endpoint**
```
DELETE /tasks/{id}
POST /tasks/{id} (with _method=DELETE for form)
```

**Success Response (302)**
```
Redirect to /tasks with flash message
Location: /tasks?success=Tugas%20berhasil%20dihapus!
```

**Not Found (404)**
```
Task not found error
```

**cURL Example**
```bash
curl -X DELETE http://localhost:8000/tasks/1 \
  -H "Accept: application/json"
```

---

## Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Request successful |
| 302 | Redirect - After successful create/update/delete |
| 404 | Not Found - Task doesn't exist |
| 422 | Unprocessable Entity - Validation error |
| 500 | Server Error |

---

## Data Types & Formats

### Category (Enum)
- `design` - Desain
- `dev` - Pengembangan
- `bug` - Bug Report
- `research` - Riset

### Priority (Enum)
- `low` - Rendah
- `medium` - Sedang
- `high` - Tinggi

### Status (Enum)
- `todo` - Belum Mulai
- `progress` - Sedang Dikerjakan
- `review` - Review
- `done` - Selesai

### Progress (Integer)
- Min: 0
- Max: 100
- Example: `50` (means 50%)

### Date Format
```
YYYY-MM-DD
Example: 2024-12-31
```

---

## Validation Rules

### Create Task
```php
[
    'title' => 'required|string|max:255',
    'description' => 'nullable|string|max:1000',
    'category' => 'required|in:design,dev,bug,research',
    'priority' => 'required|in:low,medium,high',
    'due_date' => 'nullable|date',
    'assignee' => 'nullable|string|max:255',
]
```

### Update Task
```php
[
    'status' => 'in:todo,progress,review,done',
    'priority' => 'in:low,medium,high',
    'progress' => 'integer|min:0|max:100',
]
```

---

## Response Models

### Task Object
```json
{
  "id": 1,
  "title": "Design Homepage",
  "description": "Create mockup designs",
  "category": "design",
  "priority": "high",
  "status": "progress",
  "due_date": "2024-12-31",
  "assignee": "John Doe",
  "progress": 50,
  "created_at": "2024-01-01T12:00:00Z",
  "updated_at": "2024-01-05T15:30:00Z"
}
```

### Statistics Object
```json
{
  "total": 10,
  "inProgress": 3,
  "completed": 2,
  "highPriority": 4
}
```

---

## Pagination (Future Enhancement)
```
GET /tasks?page=1&per_page=15
```

---

## Filtering (Future Enhancement)
```
GET /tasks?category=dev&priority=high&status=progress
```

---

## Sorting (Future Enhancement)
```
GET /tasks?sort=created_at&order=desc
```

---

## Error Handling

### Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### Resource Not Found
```json
{
  "message": "No query results found for model [App\\Models\\Task]."
}
```

### Server Error
```json
{
  "message": "Server error message"
}
```

---

## Rate Limiting (Future Enhancement)
```
No rate limiting currently implemented
```

---

## CORS (Cross-Origin) (Future Enhancement)
```
Currently no CORS restrictions
Add config/cors.php for production
```

---

## Examples by Language

### JavaScript (Fetch API)
```javascript
// Get all tasks
fetch('http://localhost:8000/tasks')
  .then(response => response.json())
  .then(data => console.log(data));

// Create task
fetch('http://localhost:8000/tasks', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    title: 'New Task',
    category: 'dev',
    priority: 'high'
  })
})
.then(response => response.json())
.then(data => console.log(data));
```

### Python (Requests)
```python
import requests

# Get all tasks
response = requests.get('http://localhost:8000/tasks')
tasks = response.json()

# Create task
data = {
    'title': 'New Task',
    'category': 'dev',
    'priority': 'high'
}
response = requests.post('http://localhost:8000/tasks', json=data)
```

### PHP (cURL)
```php
<?php
// Get all tasks
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/tasks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$tasks = json_decode($response, true);

// Create task
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'title' => 'New Task',
    'category' => 'dev',
    'priority' => 'high'
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
$response = curl_exec($ch);
curl_close($ch);
```

---

## Changelog

### Version 1.0.0 (Initial Release)
- Basic CRUD operations
- Kanban board grouping
- Statistics calculation
- Form validation

### Planned for Version 2.0.0
- Authentication & Authorization
- User-based filtering
- Advanced search & filtering
- Pagination
- Rate limiting
- API documentation with Swagger
- WebSocket support for real-time updates
- File attachments
- Comments system

---

## Support

For API issues:
1. Check validation requirements
2. Verify JSON format is valid
3. Check status codes and error messages
4. Review examples above
5. Check Laravel logs: `storage/logs/laravel.log`

---

## Authentication (Future)
```
When adding authentication, use:
- Laravel Sanctum (recommended)
- API tokens in header:
  Authorization: Bearer {token}
```

---

**API Version**: 1.0.0  
**Last Updated**: June 3, 2026
