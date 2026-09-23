<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>TokoBuku -Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    :root {
      --bg: #eff3fb;
      --surface: #ffffff;
      --surface-soft: #f8fafc;
      --text: #0f172a;
      --muted: #475569;
      --primary: #2563eb;
      --border: rgba(15, 23, 42, 0.08);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: var(--bg);
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .sidebar {
      width: 220px;
      min-width: 220px;
      height: 100vh;
      background: #0f172a;
      position: fixed;
      left: 0;
      top: 0;
      padding: 24px 18px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .logo {
      color: #ffffff;
      margin-bottom: 32px;
      font-size: 1.2rem;
      font-weight: 700;
      letter-spacing: 0.02em;
    }

    .menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .menu li {
      margin-bottom: 10px;
    }

    .menu a {
      color: #cbd5e1;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 14px;
      border-radius: 12px;
      transition: background 0.2s ease, color 0.2s ease;
      font-size: 0.95rem;
    }

    .menu a:hover,
    .menu a.active {
      background: rgba(37, 99, 235, 0.18);
      color: #ffffff;
    }

    .logout a {
      color: #f97316;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 14px;
      border-radius: 12px;
      transition: background 0.2s ease;
    }

    .logout a:hover {
      background: rgba(249, 115, 22, 0.12);
    }

    .content {
      margin-left: 220px;
      padding: 30px 32px;
      min-height: 100vh;
    }

    .dashboard-card {
      border-radius: 18px;
      padding: 24px;
      background: var(--surface);
      border: 1px solid var(--border);
      box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
      color: var(--text);
    }

    .dashboard-card h5 {
      color: var(--muted);
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 0.03em;
      font-size: 0.85rem;
    }

    .dashboard-card h2 {
      margin: 0;
      font-size: 2.5rem;
    }

    .bg-blue {
      border-color: rgba(37, 99, 235, 0.16);
    }

    .bg-green {
      border-color: rgba(16, 185, 129, 0.16);
    }

    .bg-orange {
      border-color: rgba(249, 115, 22, 0.16);
    }

    .table-container {
      background: var(--surface);
      border-radius: 24px;
      padding: 24px;
      box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
      border: 1px solid rgba(15, 23, 42, 0.06);
    }

    .table thead th {
      background: var(--surface-soft);
      color: #0f172a;
      border-bottom: 0;
      font-size: 0.95rem;
    }

    .table tbody tr:hover {
      background: #f8fafc;
    }

    .form-control,
    .btn {
      border-radius: 10px !important;
    }

    .pagination .page-link {
      color: #475569;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
      background: var(--primary);
      border-color: var(--primary);
      color: #ffffff;
    }

    .pagination .page-item.disabled .page-link {
      color: #94a3b8;
    }

    @media (max-width: 992px) {
      .sidebar {
        position: relative;
        width: 100%;
        min-width: auto;
        height: auto;
      }

      .content {
        margin-left: 0;
        padding: 22px;
      }
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>