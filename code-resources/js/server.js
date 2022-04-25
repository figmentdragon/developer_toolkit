const Webpack = require('webpack');
const WebpackDevServer = require('webpack-dev-server');
const webpackConfig = require('./webpack.config.js');

const compiler = Webpack(webpackConfig);
const devServerOptions = { ...webpackConfig.devServer, open: true };
const server = new WebpackDevServer(devServerOptions, compiler);

const runServer = async () => {
  console.log('Starting server...');
  await server.start(
    server.startCallback(() => {
      console.log('Successfully started server on http://localhost:8080');
    )
    })
  );
};

const stopServer = async () => {
  console.log('Stopping server...');
  await server.stop(
    server.stopCallback(() => {
      console.log('Server stopped.');
    })
  );
};

runServer();

setTimeout(stopServer, 5000);
