<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="filter">

    </div>
    <h1>Silahkan memilih Untuk membuat SID baru</h1>
    <form method="POST" action="/kirimsid">
        @include('massage.massageError')
        @csrf
        <table>
            <tr>
                <td>Originating</td>
                <td> <select required name="originating" onfocus='this.size=10;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option label="--Pilih--" hidden></option>
                        @foreach ($originating as $ori)
                            <option>{{ $ori->name }}</option>
                        @endforeach
                </td>
            </tr>

            <tr>
                <td>Terminating</td>
                <td> <select required name="terminating" onfocus='this.size=10;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                        <option label="--Pilih--" hidden></option>
                        @foreach ($terminating as $ter)
                            <option>{{ $ter->name }}</option>
                        @endforeach
                    </select> </td>
            </tr>

            <tr>
                <td>Service</td>
                <td> <select required name="service" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option label="--Pilih--" hidden></option>
                        @foreach ($service as $ser)
                            <option>{{ $ser->name }}</option>
                        @endforeach
                    </select> </td>
            </tr>

            <tr>
                <td>Bulan</td>
                <td> <select required name="bulan" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option label="--Pilih--" hidden></option>
                        @foreach ($bulan as $bul)
                            <option value="{{ $loop->iteration }}">{{ $bul }}</option>
                        @endforeach
                    </select> </td>
            </tr>

            <tr>
                <td>Tahun</td>
                <label for="year"></label>
                <td> <select required name="tahun" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option label="--Pilih--" hidden></option>
                        @for ($year = 2000; $year <= 2070; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
            </tr>
            <tr>
                <td> <button type="submit">Kirim</button></td>
            </tr>

        </table>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
