<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }

        .product {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .product img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .content {
            padding: 15px;
        }

        .content h2 {
            font-size: 20px;
            margin: 0 0 10px;
        }

        .description {
            color: #666;
            margin-bottom: 10px;
        }

        .price {
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Product List</h1>

    <div class="products">

        @foreach ($products as $product)

            <div class="product">

                @if ($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                @endif

                <div class="content">

                    <h2>{{ $product->name }}</h2>

                    <div class="description">
                        {{ $product->description }}
                    </div>

                    <div class="price">
                        ${{ number_format($product->price, 2) }}
                    </div>

                </div>

            </div>

        @endforeach

    </div>

</body>
</html>