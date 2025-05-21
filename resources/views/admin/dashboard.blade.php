<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #1e1e2f;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .admin-box {
            background-color: #2d2d44;
            border: 2px solid #00ffff;
            padding: 30px;
            border-radius: 10px;
            width: 700px;
            box-shadow: 0 0 10px #00ffff;
        }

        h2 {
            text-align: center;
        }

        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #00ffff;
        }

        th {
            background-color: #1e1e2f;
        }

        tr:hover {
            background-color: #3a3a5a;
        }

        button {
            background-color: #00ffff;
            border: none;
            padding: 8px 15px;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00cccc;
        }

        .logout-form {
            text-align: center;

        }

        .logout-form button {
            background-color: #ff4d4d;
            color: #fff;
        }

        .logout-form button:hover {
            background-color: #cc0000;
        }
    </style>
</head>

<body>

    <div class="admin-box">
        <div class="head">
            <h2>Admin Dashboard</h2>
            <div class="logout-form">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>


        <table>
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.toggleApproval', $customer->id) }}">
                                @csrf
                                <button class="toggle-approval-btn" data-id="{{ $customer->id }}">
                                    {{ $customer->is_approved ? '❌ Unapprove' : '✅ Approve' }}
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-approval-btn').click(function(e) {
            e.preventDefault();

            var button = $(this);
            var customerId = button.data('id');
            var token = $('meta[name="csrf-token"]').attr('content');

            var url = '/admin/toggleApproval/' + customerId;

            $.ajax({
                url: url,
                type: 'POST', // Must be POST
                headers: {
                    'X-CSRF-TOKEN': token // Important!
                },
                success: function(response) {
                    if (response.is_approved) {
                        button.text('❌ Unapprove');
                    } else {
                        button.text('✅ Approve');
                    }
                },
                error: function(xhr) {
                    console.error("Full error:", xhr.responseText);
                    alert("Something went wrong:\n" + xhr.responseText);
                }
            });
        });
    });
</script>



</html>
