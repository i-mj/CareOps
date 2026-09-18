# CareOps AI MVP v5 — Pilot Infrastructure

V5 adds the pilot application layer: WhatsApp webhook normalization, patient-message persistence models, AI orchestration, guarded tool calls, human escalation, usage metering, audit events, provider-neutral adapters, and a React pilot console.

Synthetic data only. Do not use real patient/PHI data until security, privacy, consent, retention, access-control and regulatory requirements are reviewed.

Provider-specific WhatsApp and healthcare API credentials/endpoints are intentionally not hard-coded. Validate current official provider documentation before production integration.

Demo webhook:
POST /api/v1/webhooks/whatsapp
{"from":"demo-patient","message_id":"wamid.demo","text":"Doctor kal available hai?"}
