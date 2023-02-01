import uvicorn
from fastapi import FastAPI
from expert import InreferenceEngine
from pydantic import BaseModel

app = FastAPI()


class Facts(BaseModel):
    facts: list = []


@app.post("/detect")
async def root(facts: Facts):
    engine = InreferenceEngine()
    engine.initialFacts = facts.facts
    engine.reset()
    engine.run()

    return {"language": engine.language}

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=5500)
