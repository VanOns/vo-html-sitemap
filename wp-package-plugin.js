const fs = require('fs')
const archiver = require('archiver')
const filename = 'vo-html-sitemap'

const output = fs.createWriteStream(process.cwd() + '/' + filename + '.zip')
const archive = archiver('zip', {
    zlib: { level: 9 } // Compression level.
})

output.on('close', function () {
    console.log(archive.pointer() + ' total bytes')
    console.log('archiver has been finalized and the output file descriptor has closed.')
})

output.on('end', function () {
    console.log('Data has been drained')
})

archive.on('warning', function (err) {
    if (err.code === 'ENOENT') {
    } else {
        throw err
    }
})

archive.on('error', function (err) {
    throw err
})

archive.pipe(output)

archive.glob('**',
    {
        ignore: [
            '.idea',
            '.babelrc',
            '.git',
            '.gitignore',
            '.github',
            '.editorconfig',
            '.npmrc',
            '.nvmrc',
            '.prettierrc',
            'webpack.config.js',
            'wp-package-plugin.js',
            'node_modules/**',
            'assets/**',
            'docker/**',
            'package.json',
            'package-lock.json',
            'docker-compose.yml',
            'Dockerfile',
            'docker-compose-override.yml',
            filename + '.zip'
        ]
    },
    {
        prefix: filename
    }
)

archive.finalize()
