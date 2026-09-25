<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - ชยางกูร กุลวงษ์</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .profile-card {
            width: 100%;
            max-width: 650px;
            padding: 45px 35px;
            text-align: center;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .profile-image {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
        }

        .name {
            font-size: 34px;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .student-id {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 30px;
        }

        .student-id span {
            color: #4f46e5;
            font-weight: bold;
        }

        .about-title {
            display: inline-block;
            padding: 8px 20px;
            margin-bottom: 22px;
            border-radius: 20px;
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        .links {
            display: grid;
            gap: 14px;
            max-width: 450px;
            margin: auto;
        }

        .project-link {
            display: block;
            padding: 15px 20px;
            border-radius: 14px;
            text-decoration: none;
            background: #f8fafc;
            color: #334155;
            border: 1px solid #e2e8f0;
            font-size: 17px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .project-link:hover {
            transform: translateY(-4px);
            color: white;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-color: transparent;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .footer {
            margin-top: 30px;
            color: #94a3b8;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .profile-card {
                padding: 35px 20px;
            }

            .profile-image {
                width: 140px;
                height: 140px;
            }

            .name {
                font-size: 27px;
            }

            .project-link {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="profile-card">

        <img
            src="/images/profile.jpg"
            alt="Profile"
            class="profile-image"
        >

        <h1 class="name">ชยางกูร กุลวงษ์</h1>

        <p class="student-id">
            รหัสนักศึกษา:
            <span>68122420023</span>
        </p>

        <div class="about-title">
            About Me
        </div>

        <div class="links">
            <a href="/gallery" class="project-link">
                EP02 Hero
            </a>

            <a href="/active/index" class="project-link">
                EP03 Active Bootstrap
            </a>

            <a href="/weights" class="project-link">
                EP07 Weight
            </a>

            <a href="/login" class="project-link">
                EP08 Auth
            </a>
        </div>

        <div class="footer">
            Laravel 12 · Web Development
        </div>

    </div>

</body>
</html>
