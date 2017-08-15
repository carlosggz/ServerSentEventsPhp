        function LongTask(config) {

            var self = this;
            this.myTask = new EventSource(config.url);

            this.myTask.addEventListener('Notification', function(e) {
                var result = JSON.parse(e.data);
                config.onProgress(result.progress);

                if (parseInt(result.progress) == 100) {
                    self._close();
                    config.onFinish();
                }
            });

            this.myTask.addEventListener('error', function(e) {
                self._close();
                config.onError(e);
            });

            this._close = function() {
                self.myTask.close();
                self.myTask = null;
            };
        }