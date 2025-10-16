<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Details</title>
    
</head>
<body>
    <div class="container">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
            
            <td align="center" bgcolor="#f4f4f4">
                <table cellspacing="0" cellpadding="0" border="0" width="600">
                    {{-- <tr>
                        <td align="center" bgcolor="#333">
                            <img src="https://example.com/logo.png" alt="Company Logo" width="150" height="150">
                        </td>
                    </tr> --}}
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <h1>Appointment Booked</h1><br><hr>
                                <tr>
                                    <td style="font-size: 24px; font-weight: bold; color: #333;">Appointment Details</td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 30px 0; font-size: 16px; color: #666;">
                                        <p>Dear Admin,</p>
                                        <p>New Appointment Added:</p>
                                        <ul>
                                            <li><strong>Patient Name:</strong> {{$appointment->name}}</li>
                                            <li><strong>Patient Age:</strong> {{$appointment->age}}</li>
                                            <li><strong>Doctor Name:</strong> Dr. {{$appointment->doctor->name}}</li>
                                            <li><strong>Hospital Name:</strong> {{$appointment->hospital->hospital_name}}</li>
                                            <li><strong>Appointment Date:</strong> {{$appointment->date}}</li>
                                            <li><strong>Appointment Start Time:</strong> {{$appointment->start_time}}</li>
                                            <li><strong>Appointment End Time:</strong> {{$appointment->end_time}}</li>
                                            <li><strong>Patient Phone Number:</strong> {{$appointment->phone}}</li>
                                        </ul>
                                        <p>Thank you!</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#333" style="padding: 20px; text-align: center;">
                            <p style="color: #fff;">&#169; 2023 HyScaler All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
