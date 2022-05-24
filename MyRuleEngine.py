import re
import sys
import json

q = ''

def ask2(obj):
    global q
    print('Does the pc have the following attribute: is ', obj)
    q = 'Does the pc have the following attribute: ' + str(obj)
    #rd = input()
    rd = 'n.'
    if rd == 'y.':
        return True
    return 'unknown'

def ask(obj):
    print('Does the pc have the following attribute: is ', str(obj))
    return input() == 'y.'

rulesb = {'cheap': 'run ask(\'is_cheap\')', 'ryzen3': 'run verify(\'cheap\')', 'ram4': 'cheap or cheap'}
const_rules = {'cheap': 'run ask(\'cheap\')',
         'gamer': 'run ask(\'gamer\')',
         'intel': 'run ask(\'intel\')',
         'no_gamer': 'not gamer',
         'no_cheap': 'not cheap',
         'amd': 'not intel',
         'ram16gb': 'gamer',
         'ram8gb': 'no_gamer and not cheap',
         'ram4gb': 'no_gamer and cheap',
         'ryzen9': 'amd and gamer',
         'ryzen5': 'amd and no_gamer and no_cheap',
         'ryzen3': 'amd and cheap and no_gamer',
         'corei3': 'intel and cheap and no_gamer',
         'corei5': 'intel and no_gamer and no_cheap',
         'corei9': 'intel and gamer',
         'unknown': True
         }

rules = {}
def clean():
    rules.clear()
    rules.update(const_rules)

def verify(obj, debug:bool = False):
    if debug:
        print(str(obj), rules.get(obj))
    if obj == None:
        return False
    if type(rules.get(obj)) == bool:
        return rules[obj]
    elif type(obj) == str:
        if obj == 'unknown':
            return 'unknown'
        if obj.startswith('not '):
            return not(verify(obj[4:], debug))
        elif obj.startswith('run '):
            exec('rules.update({obj: ' + obj[4:] + '})')
            return rules[obj]
        x = re.search('(.*) and (.*)', obj)
        if debug: print('re')
        if x:
            if debug: print('and')
            return (verify(x[1], debug) and verify(x[2], debug))
        x = re.search('(.*) or (.*)', obj)
        if x:
            if debug: print('or')
            return (verify(x[1], debug) or verify(x[2], debug))
    if type(rules.get(obj)) == str:
        if rules.get(obj).startswith('not '):
            return not(verify(rules.get(obj)[4:]) )
        elif rules.get(obj).startswith('run '):
            exec('rules.update({obj: ' + str(rules.get(obj))[4:] + '})')
            return rules[obj]
        x = re.search('(.*) and (.*)', rules.get(obj))
        if x:
            return (verify(x[1]) and verify(x[2]))
        x = re.search('(.*) or (.*)', rules.get(obj))
        if x:
            return (verify(x[1]) or verify(x[2]))
    elif verify(rules.get(obj), debug):
        return True
    return 'unknown'

def hypothesize(data : [str]) -> str:
    for i in data:
        if verify(i, False):
            return i
    return 'unknown'

cpus = ['ryzen3', 'ryzen5', 'ryzen9', 'corei3', 'corei5', 'corei9']
rams = ['ram16gb', 'ram8gb', 'ram4gb']

if __name__ == '__main__':
    args_json = json.loads(sys.argv[1])
    clean()
    rules.update(args_json)
    print(hypothesize(cpus))
    print(hypothesize(rams))

