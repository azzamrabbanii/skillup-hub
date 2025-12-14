<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Completion</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; text-align: center; border: 10px solid #787878; padding: 50px; }
        .container { border: 5px double #787878; padding: 40px; height: 90%; }
        .header { font-size: 50px; font-weight: bold; color: #333; margin-bottom: 20px; }
        .subheader { font-size: 25px; margin-bottom: 20px; }
        .name { font-size: 40px; font-weight: bold; color: #4a5568; text-decoration: underline; margin: 20px 0; }
        .course { font-size: 30px; font-weight: bold; color: #2d3748; margin: 20px 0; }
        .footer { margin-top: 50px; font-size: 18px; color: #777; }
        .logo { font-size: 20px; font-weight: bold; color: #d53f8c; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">SKILLUP HUB</div>

        <div class="header">CERTIFICATE</div>
        <div class="subheader">OF COMPLETION</div>

        <p>This is to certify that</p>

        <div class="name">{{ $user->name }}</div>

        <p>has successfully completed the course</p>

        <div class="course">{{ $course->name }}</div>

        <div class="footer">
            <p>Date: {{ date('d F Y') }}</p>
            <p>Instructor: {{ $course->teacher->name }}</p>
        </div>
    </div>
</body>
</html>
