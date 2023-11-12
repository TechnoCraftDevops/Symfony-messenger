//0 nothing, 1 warning, 2 errors
module.exports = {
    rules: {
      'type-enum': [
        2,
        'always',
        [
          'build',
          'chore',
          'ci',
          'docs',
          'feat',
          'fix',
          'perf',
          'refactor',
          'revert',
          'style',
          'test',
        ],
      ],
      'scope-empty': [
        2,
        'never'
      ],
      'subject-empty':[
        2,
        'never'
      ]
    },
  };
  