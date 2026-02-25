import './bootstrap';

const AUTO_SUBMIT_FOCUS_KEY = 'auto-submit-focus';

const header = document.querySelector('header');

if (header) {
	const COMPACT_ENTER_Y = 20;
	const COMPACT_EXIT_Y = 1;

	let isCompact = header.classList.contains('is-compact');
	let ticking = false;

	const updateCompactHeader = () => {
		const currentY = window.scrollY;

		if (!isCompact && currentY >= COMPACT_ENTER_Y) {
			isCompact = true;
			header.classList.add('is-compact');
			document.body.classList.add('header-is-compact');
		} else if (isCompact && currentY <= COMPACT_EXIT_Y) {
			isCompact = false;
			header.classList.remove('is-compact');
			document.body.classList.remove('header-is-compact');
		}
	};

	const onScroll = () => {
		if (ticking) {
			return;
		}

		ticking = true;
		window.requestAnimationFrame(() => {
			updateCompactHeader();
			ticking = false;
		});
	};

	updateCompactHeader();
	window.addEventListener('scroll', onScroll, { passive: true });
}

const autoSubmitForms = document.querySelectorAll('form[data-auto-submit]');

const restoreAutoSubmitFocus = () => {
	const rawState = sessionStorage.getItem(AUTO_SUBMIT_FOCUS_KEY);
	if (!rawState) {
		return;
	}

	let focusState;
	try {
		focusState = JSON.parse(rawState);
	} catch {
		sessionStorage.removeItem(AUTO_SUBMIT_FOCUS_KEY);
		return;
	}

	const isFresh = typeof focusState?.ts === 'number' && Date.now() - focusState.ts < 8000;
	if (!isFresh || focusState?.path !== window.location.pathname || !focusState?.name) {
		sessionStorage.removeItem(AUTO_SUBMIT_FOCUS_KEY);
		return;
	}

	for (const form of autoSubmitForms) {
		const input = form.querySelector(`input[name="${focusState.name}"]`);
		if (!input) {
			continue;
		}

		input.focus({ preventScroll: true });
		if (typeof focusState.selectionStart === 'number' && typeof focusState.selectionEnd === 'number') {
			input.setSelectionRange(focusState.selectionStart, focusState.selectionEnd);
		}

		sessionStorage.removeItem(AUTO_SUBMIT_FOCUS_KEY);
		return;
	}

	sessionStorage.removeItem(AUTO_SUBMIT_FOCUS_KEY);
};

restoreAutoSubmitFocus();

autoSubmitForms.forEach((form) => {
	const saveFocusState = (element) => {
		if (!(element instanceof HTMLInputElement) || document.activeElement !== element || !element.name) {
			return;
		}

		sessionStorage.setItem(
			AUTO_SUBMIT_FOCUS_KEY,
			JSON.stringify({
				path: window.location.pathname,
				name: element.name,
				selectionStart: element.selectionStart,
				selectionEnd: element.selectionEnd,
				ts: Date.now(),
			})
		);
	};

	const submitForm = (sourceElement) => {
		saveFocusState(sourceElement);

		if (typeof form.requestSubmit === 'function') {
			form.requestSubmit();
			return;
		}

		form.submit();
	};

	const updateSearchHint = (input) => {
		if (!(input instanceof HTMLInputElement)) {
			return;
		}

		const hintId = input.dataset.hintId;
		if (!hintId) {
			return;
		}

		const hint = form.querySelector(`#${hintId}`);
		if (!hint) {
			return;
		}

		const appliedValue = (input.dataset.appliedValue ?? '').trim();
		const currentValue = input.value.trim();
		const shouldShow = currentValue.length > 0 && currentValue !== appliedValue;

		hint.classList.toggle('is-visible', shouldShow);
	};

	const textInputs = form.querySelectorAll('input[type="text"], input[type="search"]');
	textInputs.forEach((input) => {
		updateSearchHint(input);

		input.addEventListener('input', () => {
			updateSearchHint(input);
		});

		input.addEventListener('keydown', (event) => {
			if (event.key === 'Enter') {
				submitForm(input);
				event.preventDefault();
			}
		});
	});

	const selects = form.querySelectorAll('select');
	selects.forEach((select) => {
		select.addEventListener('change', () => submitForm());
	});
});
