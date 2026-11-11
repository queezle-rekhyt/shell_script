#!/bin/bash

# 入力ファイルのパス
FILE="data.txt"

# ファイルを1行ずつ読み込む
while IFS= read -r line || [[ -n "$line" ]]; do
  # 空行をスキップする場合
  [[ -z "$line" ]] && continue

  echo "送信中: $line"

  # フォームデータとして送信する例 (POST送信する場合)
  curl -S -i -L -c cookie.txt -d POST --data "user=$line" http://localhost:8080/check.php
  curl -S -i -L -b cookie.txt -d POST --data "user=$line" http://localhost:8080/success.php
  #case GETmethod
  #curl -s "https://example.com{line}"

  # サーバーに負荷をかけないようウェイトを入れる場合
  sleep 1

done < "$FILE"

