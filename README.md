<!--<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>-->

<!--<p align="center">-->
<!--<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>-->
<!--<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>-->
<!--<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>-->
<!--<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>-->
<!--</p>-->

<!--最初にロゴ・アイキャッチ画像などを表示-->

![デモ](./README_image/Todo.jpg)



<!--## デモ-->

<!--![デモ](https://image-url.gif)-->

## Todoリストの目的

仕事上、マルチタスクを抱えている人は多いでしょう。
複数のプロジェクトが同時に進行している場合は、こなさなければならないタスクが増え、しかもそれぞれに期日があるはずです.
Todo リストの目的は、こういった状態に陥っても作業のし忘れを防止し、期限までに適切に実行すること、またそれを管理することです。



## Todoアプリの使い方

1. "まだアカウントを作成していない方"より、アカウントの新規登録をしてください。
2. 新規登録の際、自分がTodo一覧で表示してほしいニックネームを入力してください。
2. "Todoを入力してください"の部分にカーソルを合わせて、自分のTodoを入力してください。
3. その右隣(スマートフォン,iPhoneの方は下)にあるカレンダーをクリックし、Todoの予定日時や期限を入力してください。
4. Todoが完了したら完了ボタンを押してください。
5. 完了したTodoは横線が引かれ、完了ボタンは押せなくなります。
6. 未完了のTodoの下に表示されるようになります。自動では消えませんので、自分が消したいタイミングで削除お願いします。
5. Todoの内容や日時を途中で変更したい時は、編集ボタンを押したら、編集画面に飛びます。
6. 変更したいものの場所にカーソルを合わせて入力して、編集ボタンを押してください。
7. パスワードを忘れた方は"パスワードを忘れた"より、e-mailアドレスを入力し、パスワードの再発行を行ってください。


## 要件定義


1. ユーザー登録ができる。この際に登録した名前（ニックネーム）が、MyTodoの一覧で表示される。
2. Todoと期限日時を登録できる。
3. ユーザーが登録しているTodoを、上から順番に、予定の日時順に一覧形式で表示できる。
4. 明日のTodoリストは、赤文字で表示される
5. 編集ボタンを押したら、編集画面へ移る。
6. ユーザーが完了したTodoを完了にできる。完了したTodoは横線が引かれ、完了ボタンは押せなくなる。
7. 完了されたTodoは削除されずに、未完了の下に表示される。
8. ユーザーが削除したいタイミングでTodoを削除できる。
9. パスワードを忘れた場合、e-mailアドレスより、パスワードをリセットし再発行できる。

サービスは複数のユーザーが利用できる想定とし、ユーザーは自身が登録したTodoを操作できます。
サービスを利用するためには、アカウントを登録してユーザー認証を行う必要があります。


## 開発環境　

* Amazon Linux 2
* Laravel 9.41.0
* PHP 8.0.25
* Node.js 16.18.0
* npm 8.19.2
* MySQ 14.14
* bootstrap5を使用
* Authを利用している



## ER図

![ER図](./README_image/ER.jpg)



## 参考文献

https://b-risk.jp/blog/2022/08/laravel/#i-11

https://www.hypertextcandy.com/laravel-tutorial-create-task

Laravel パスワードリセット機能の実装方法を解説<br>
https://takuma-it.com/laravel-password-reset/