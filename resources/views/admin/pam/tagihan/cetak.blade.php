<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Tagihan PAM - {{ $pamTagihan->pelanggan->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            background: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .no-print {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .btn-print {
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-close {
            background: #6b7280;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print:hover {
            background: #1d4ed8;
        }

        .btn-close:hover {
            background: #4b5563;
        }

        .struk {
            background: white;
            width: 300px;
            padding: 20px 16px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .header .nama-dusun {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header .subtitle {
            font-size: 10px;
            color: #555;
            margin-top: 2px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 10px 0;
            border-top: 1px dashed #999;
            border-bottom: 1px dashed #999;
            padding: 6px 0;
        }

        .divider {
            border: none;
            border-top: 1px dashed #999;
            margin: 10px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            line-height: 1.5;
        }

        .row .label {
            color: #555;
            flex-shrink: 0;
            min-width: 120px;
        }

        .row .value {
            text-align: right;
            font-weight: 500;
            word-break: break-word;
            max-width: 140px;
        }

        .section-title {
            font-size: 10px;
            text-transform: uppercase;
            color: #888;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            margin-top: 4px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid #333;
            font-size: 14px;
            font-weight: bold;
        }

        .status-lunas {
            text-align: center;
            margin: 12px 0 4px;
            font-size: 20px;
            font-weight: bold;
            color: #16a34a;
            letter-spacing: 4px;
            border: 2px solid #16a34a;
            padding: 4px;
        }

        .status-belum {
            text-align: center;
            margin: 12px 0 4px;
            font-size: 16px;
            font-weight: bold;
            color: #dc2626;
            letter-spacing: 2px;
            border: 2px dashed #dc2626;
            padding: 4px;
        }

        .footer {
            text-align: center;
            margin-top: 12px;
            font-size: 10px;
            color: #888;
            line-height: 1.6;
        }

        .struk-no {
            text-align: center;
            font-size: 10px;
            color: #888;
            margin-bottom: 6px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .struk {
                box-shadow: none;
                width: 100%;
                max-width: 300px;
            }

            @page {
                size: 80mm auto;
                margin: 4mm;
            }
        }
    </style>
</head>

<body>
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">Cetak Struk</button>
        <button class="btn-close" onclick="window.close()">Tutup</button>
    </div>

    <div class="struk">
        <div class="header">
            @if ($profile && $profile->logo)
                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo"
                    style="height:40px; margin-bottom:4px;">
            @endif
            <div class="nama-dusun">{{ $profile ? $profile->name : config('app.name') }}</div>
            @if ($profile && $profile->address)
                <div class="subtitle">{{ $profile->address }}</div>
            @endif
            @if ($profile && $profile->phone)
                <div class="subtitle">Telp: {{ $profile->phone }}</div>
            @endif
        </div>

        <div class="title">Struk Tagihan Air</div>

        <div class="struk-no">No. Struk: PAM-{{ str_pad($pamTagihan->id, 5, '0', STR_PAD_LEFT) }}</div>

        <div class="section-title">Data Pelanggan</div>
        <div class="row">
            <span class="label">No. Meteran</span>
            <span class="value">{{ $pamTagihan->pelanggan->nomor_meteran }}</span>
        </div>
        <div class="row">
            <span class="label">Nama</span>
            <span class="value">{{ $pamTagihan->pelanggan->nama }}</span>
        </div>
        <div class="row">
            <span class="label">Alamat</span>
            <span class="value">{{ $pamTagihan->pelanggan->alamat }}</span>
        </div>
        <div class="row">
            <span class="label">RT/RW</span>
            <span class="value">RT {{ $pamTagihan->pelanggan->rt }} / RW {{ $pamTagihan->pelanggan->rw }}</span>
        </div>

        <hr class="divider">

        <div class="section-title">Rincian Tagihan</div>
        <div class="row">
            <span class="label">Periode</span>
            <span class="value">{{ $namaBulan[$pamTagihan->bulan] }} {{ $pamTagihan->tahun }}</span>
        </div>
        <div class="row">
            <span class="label">Meteran Awal</span>
            <span class="value">{{ number_format($pamTagihan->angka_awal, 2, ',', '.') }} m³</span>
        </div>
        <div class="row">
            <span class="label">Meteran Akhir</span>
            <span class="value">{{ number_format($pamTagihan->angka_akhir, 2, ',', '.') }} m³</span>
        </div>
        <div class="row">
            <span class="label">Pemakaian</span>
            <span class="value">{{ number_format($pamTagihan->pemakaian, 2, ',', '.') }} m³</span>
        </div>
        <div class="row">
            <span class="label">Tarif/m³</span>
            <span class="value">Rp {{ number_format($pamTagihan->tarif_saat_catat, 0, ',', '.') }}</span>
        </div>

        <div class="total-row">
            <span>TOTAL</span>
            <span>Rp {{ number_format($pamTagihan->total_tagihan, 0, ',', '.') }}</span>
        </div>

        <hr class="divider">

        @if ($pamTagihan->status === 'sudah_bayar')
            <div class="status-lunas">LUNAS</div>
            <div class="row">
                <span class="label">Tgl Bayar</span>
                <span class="value">{{ $pamTagihan->tanggal_bayar->format('d/m/Y') }}</span>
            </div>
        @else
            <div class="status-belum">BELUM LUNAS</div>
        @endif

        @if ($pamTagihan->keterangan)
            <hr class="divider">
            <div class="row">
                <span class="label">Keterangan</span>
                <span class="value">{{ $pamTagihan->keterangan }}</span>
            </div>
        @endif

        <hr class="divider">

        <div class="footer">
            <div>Dicetak: {{ now()->format('d/m/Y H:i') }}</div>
            <div>Petugas: {{ $pamTagihan->user->name }}</div>
            <br>
            <div>--- Terima Kasih ---</div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
