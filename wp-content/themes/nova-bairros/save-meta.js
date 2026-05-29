import fs from "fs";
import https from "https";

const base = "https://www.cassind.com.br/assets/img/meta/";

const files = [
  "favicon.png",
  "apple-touch-icon-57x57.png",
  "apple-touch-icon-114x114.png",
  "apple-touch-icon-72x72.png",
  "apple-touch-icon-144x144.png",
  "apple-touch-icon-60x60.png",
  "apple-touch-icon-120x120.png",
  "apple-touch-icon-76x76.png",
  "apple-touch-icon-152x152.png",
];

files.forEach((file) => {
  const url = base + file;
  const path = `./assets/img/meta/${file}`;

  https.get(url, (res) => {
    if (res.statusCode === 200) {
      res.pipe(fs.createWriteStream(path));
      console.log(`Downloaded: ${file}`);
    } else {
      console.log(`Failed: ${file}`);
    }
  });
});