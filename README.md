# Scripts that merges multiple GPX/TCX files into one

## TCX fixer
Removes blank characters from the begining and the end of the TCX file.
Reads files from folder tcx/ and saves fixed files in tcx/fixed/.
```shell
php fix_tcxes.php
```


## TCX to GPX
Converts TCX files to GPX.
Reads files from folder tcx/fixed and saves converted files in gpx with prefix converted_from_tcx_
```shell
php tcx_to_gpx.php
```

## Merge
Merges all GPX files from folder gpx/ into one file out/merged.gpx
```shell
php merge.php
```

## Example result

![Merged tracks](screenshot/output.png)

## Blog

[[PL] Artykuł: Scalenie tras rowerowych z plików .gpx i .tcx w PHP.](https://programisty-dzien-powszedni.pl/scalenie-tras-rowerowych-z-plikow-gpx-i-tcx-w-php/)
