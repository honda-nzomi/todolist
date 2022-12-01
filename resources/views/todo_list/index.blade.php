 
<!DOCTYPE html>
<html lang="ja">
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>タイトル</title>
  <!--TailWindCssの導入のため-->
  <script src="https://cdn.tailwindcss.com"></script>

</head>
 
<body>
  <!--ビューを表示する用のファイルとして、Bladeテンプレートを使用 -->
  <!--Bladeテンプレート内でスクリプトを書く際は、-->
  <!--基本的にアットマークから始まるBladeディレクティブを使用-->
  <!--もし、空じゃなければ-->
  @if ($todo_lists->isNotEmpty())
    <div class="container px-5 mx-auto">
      <ul class="font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
        <!--コントローラーから渡ってきた変数「todol_lists」は、「コレクション型」という型の配列のようなもので渡ってくる-->
        @foreach ($todo_lists as $item)
          <li class="py-4 px-5 w-full rounded-t-lg border-b last:border-b-0 border-gray-200">
              <!--変数の出力は波括弧を２つ重ねる-->
              {{ $item->name }}
          </li>
        @endforeach
      </ul>
    </div>
  @endif
 
</body>
 
</html>