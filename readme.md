# vue-ts-bitcoin-api
2

3
## Overview
4

5
---
6

7
SPA でビットコインの価格を取得するアプリです
8

9
decorator を使用せず、Vue TypeScript を使用しベストプラクティスを目指したもの
10

@shunkominato
　jest VButton.vue
11 days ago
11
-   component を Atomic Design で分割
@shunkominato
init
11 days ago
12
-   flux 設計で vuex を構築
13
-   テストコードは jest を使用
14

15
やはり decorator を使用しないとインテリセンスが効かずしんどい...
16

17
## Description
18

19
---
20

@shunkominato
comment add
10 days ago
21
component を Atomic Design で分割しているが、tmplates と pages は使用していない  
@shunkominato
init
11 days ago
22
view フォルダが pages に当たる  
@shunkominato
comment add
10 days ago
23
state などの型定義は stores/entities/entities.ts で定義  
24
Axios 通信を実行するのは/stores/asyncRequest.ts であり、共通ライブラリとして使用するため、レスポンスの型を any としている
25

26
-   vuex の流れ  
27
    1.components or views で dispach し、 stores/actions.ts の Actions を呼ぶ  
28
    2.Actions で Api を実行(Axios)  
29
    3.実行後、Actions から Mutation を呼び出し、state を更新  
30
    4.components or views で computed にて getters を呼び、価格を取得する
31

32
-   ルール  
33
    actions に dispatch するのは view のみに統一  
34
    molecules 以下は dataless  
35
    props down emit up  
36
    props を子コンポーネントで更新しない
@shunkominato
　jest VButton.vue
11 days ago
37

@shunkominato
init
11 days ago
38
## install
39

40
---
41

42
1.install
43

44
```bash
45
$ yarn install
46
```
47

48
2.起動
49

50
```bash
51
$ yarn dev
52
```
53

54
## test
55

56
---
57

58
```bash
59
$ yarn test
60
```