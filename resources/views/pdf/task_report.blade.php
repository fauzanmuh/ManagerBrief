<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Report</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
        }
        table, th, td { 
            border: 1px solid black; 
            padding: 10px; 
        }
        th { 
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>
    <h1>Task Report untuk {{ $monthName }} {{ $year }}</h1>
    <p><strong>Developer:</strong> {{ $developerName }}</p> <!-- Nama developer -->
    <p><strong>Bulan:</strong> {{ $monthName }}</p>
    <p><strong>Tahun:</strong> {{ $year }}</p>
    <p><strong>Total Overtime Hours:</strong> {{ $totalOvertime }} hours</p>

    <table>
        <thead>
            <tr>
                <th>Module</th>
                <th>Module Code</th>
                <th>Task</th>
                <th>Task Code</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Task Status</th>
                <th>Is Overtime</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taskReports as $report)
                <tr>
                    <td>{{ $report->module->module_name }}</td>
                    <td>{{ $report->module->module_code }}</td>
                    <td>{{ $report->task->task_name }}</td>
                    <td>{{ $report->task->task_code }} </td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->start_time }}</td>
                    <td>{{ $report->end_time }}</td>
                    <td>{{ ucfirst($report->task_status) }}</td>
                    <td>{{ $report->is_overtime ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>