(function ($) {
  function KHCountdown(id) {
    this.id = id;
    let self = this;

    function cacheElements(id) {
      let $countDown = $(`[data-id=${id}]`).find(".kh-countdown-wrapper");
      self.cache = {
        $countDown: $countDown,
        timeInterval: null,
        elements: {
          $countdown: $countDown.find(".kh-countdown-wrapper"),
          $daysSpan: $countDown.find(".kh-countdown-days"),
          $hoursSpan: $countDown.find(".kh-countdown-hours"),
          $minutesSpan: $countDown.find(".kh-countdown-minutes"),
          $secondsSpan: $countDown.find(".kh-countdown-seconds"),
          $expireMessage: $countDown
            .parent()
            .find(".kh-countdown-expire--message"),
        },
        data: {
          id: id,
          endTime: new Date($countDown.data("date") * 1000),
        },
      };
    }
    cacheElements(this.id);
    initializeClock();

    function updateClock(id) {
      const timeRemaining = getTimeRemaining(self.cache.data.endTime);

      jQuery.each(timeRemaining.parts, function (timePart) {
        let $element = self.cache.elements["$" + timePart + "Span"];

        let partValue = this.toString();

        if (1 === partValue.length) {
          partValue = 0 + partValue;
        }

        if ($element.length) {
          $element.text(partValue);
        }
      });

      if (timeRemaining.total <= 0) {
        clearInterval(self.cache.timeInterval);
      }
    }
    function initializeClock() {
      updateClock();
      self.cache.timeInterval$ = setInterval(function () {
        updateClock();
      }, 1000);
    }

    function getTimeRemaining(endTime) {
      let timeRemaining = endTime - new Date();
      let seconds = Math.floor((timeRemaining / 1000) % 60),
        minutes = Math.floor((timeRemaining / 1000 / 60) % 60),
        hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24),
        days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

      if (days < 0 || hours < 0 || minutes < 0) {
        seconds = minutes = hours = days = 0;
      }

      return {
        total: timeRemaining,
        parts: {
          days: days,
          hours: hours,
          minutes: minutes,
          seconds: seconds,
        },
      };
    }
  }
  $(".kh-widget-countdown_kvitna").each(function () {
    new KHCountdown($(this).data("id"));
  });
})(jQuery);
