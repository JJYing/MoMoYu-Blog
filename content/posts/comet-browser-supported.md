---
title: "支持 Comet 浏览器的网页统计"
description: "摸摸鱼计时器目前已支持 6 种浏览器"
date: 2025-11-18
author: "JJ Ying"
tags:
  - 更新日志
slug: "comet-browser-supported"
# 或者使用 url 完全自定义：
# url: "/posts/comet-browser-supported/"
---

目前 `V1.1.12` 版本已经支持网页统计的浏览器已经包括：

- Chrome
- Edge
- Safari
- OpenAI Atlas
- Brave
- Comet

但是很遗憾，目前大家呼声很高的 **FireFox** 以及 The Browser Company 的 **Arc** 以及 **Dia** 都支持不了，因为我们现在使用计时方案是利用 macOS 自带的 Automation 里的命令来获取当前 tab 的 URL，但 FireFox 天生不支持相关命令，Chromium 内核的浏览器本来应该都是支持的，但 Arc 以及 Dia 不知为何把整个 Automation 都给去掉了所以也获取不到，暂时没有太好的办法~