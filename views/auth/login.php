<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TokoBuku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background: #ffffff;
            width: 100%;
            max-width: 420px;
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>

<body>

    <div class="login-card p-4 p-sm-5 m-3">
        <div class="text-center mb-4">
            <div class="brand-icon mb-3">
                <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Login Admin Panel</h4>
            <p class="text-muted small">Masuk untuk mengelola katalog TokoBuku</p>
        </div>

        <?php if ($error === 'invalid'): ?>
            <div class="alert alert-danger d-flex align-items-center small py-2 rounded-3 mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-6"></i>
                <div>Username atau password salah!</div>
            </div>
        <?php elseif ($error === 'empty'): ?>
            <div class="alert alert-warning d-flex align-items-center small py-2 rounded-3 mb-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2 fs-6"></i>
                <div>Harap isi username dan password!</div>
            </div>
        <?php elseif ($error === 'unauthorized'): ?>
            <div class="alert alert-warning d-flex align-items-center small py-2 rounded-3 mb-3" role="alert">
                <i class="bi bi-shield-lock-fill me-2 fs-6"></i>
                <div>Anda harus login untuk mengakses panel admin.</div>
            </div>
        <?php endif; ?>

        <?php if ($success === 'logout'): ?>
            <div class="alert alert-success d-flex align-items-center small py-2 rounded-3 mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-6"></i>
                <div>Anda telah berhasil logout.</div>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login-process" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold text-secondary small">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Masukkan username admin" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold text-secondary small">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0 rounded-start-3"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Admin Panel
            </button>
        </form>

        <div class="text-center border-top pt-3 mt-3">
            <a href="index.php" class="text-decoration-none text-muted small fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog Publik
            </a>
        </div>
    </div>

</body>

</html>
