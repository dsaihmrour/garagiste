<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        /* Card */
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Card Body */
        .card-body {
            padding: 20px;
        }

        /* Header */
        header {
            margin-bottom: 20px;
            text-align: center;
        }

        /* Company Details */
        .company-details {
            text-align: left;
        }

        /* Invoice To */
        .invoice-to {
            margin-bottom: 20px;
        }

        /* Invoice Details */
        .invoice-details {
            margin-bottom: 20px;
        }

        /* Table */
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        /* Table Head */
        th {
            border-bottom: 2px solid #ddd;
            font-weight: bold;
            padding: 10px 0;
        }

        /* Table Body */
        td {
            padding: 10px 0;
        }

        /* Table Footer */
        tfoot {
            border-top: 2px solid #ddd;
        }

        /* Thanks */
        .thanks {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        /* Notices */
        .notices {
            margin-top: 20px;
            color: #777;
        }

        /* Notice */
        .notice {
            margin-top: 10px;
        }

        /* Links */
        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Logo */
        .logo {
            width: 80px;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>

</head>

<body>
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
                                        <img src="{{ public_path('/assets/images/logo-img.png') }}" alt="image-example"
                                            width="80">
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a href="javascript:;">
                                            {{ env('/APP_NAME') }}
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>garagiste@example.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $invoice->user->firstName }} {{ $invoice->user->lastName }}
                                    </h2>
                                    <div class="address">{{ $invoice->user->address }}</div>
                                    <div class="email"><a
                                            href="mailto:john@example.com">{{ $invoice->user->email }}</a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE {{ $invoice->id }}</h1>
                                    <div class="date">Date of Invoice: {{ $invoice->created_at }}</div>
                                    <div class="date">Due Date: {{ $invoice->dueDate }}</div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Repairs --}}
                                    @foreach ($repairs as $r)
                                        <tr>
                                            <td class="no">{{ $r->id }}</td>
                                            <td class="text-left">
                                                <h3 style="display: block">
                                                    <a
                                                        href="{{ route('repair.details', ['repair' => $r]) }}">{{ $r->title }}</a>
                                                </h3>
                                                {{ $r->description }}
                                            </td>
                                            <td class="unit">{{ $r->hourPrice }}</td>
                                            <td class="qty">{{ $r->hours }}</td>
                                            <td class="total">{{ $r->hourPrice * $r->hours }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>{{ $invoice->totalAmount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 25%</td>
                                        <td>{{ $invoice->additionalCharges }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>{{ $invoice->additionalCharges + $invoice->totalAmount }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30
                                    days.</div>
                            </div>
                        </main>
                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
